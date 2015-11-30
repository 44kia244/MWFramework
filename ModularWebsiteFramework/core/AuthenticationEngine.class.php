<?php
	/****************************************************************************************
	*	This file is part of ModularWebsiteFramework.                                       *
	*	                                                                         			*
	*	ModularWebsiteFramework is free software: you can redistribute it and/or modify     *
	*	it under the terms of the GNU General Public License as published by                *
	*	the Free Software Foundation, either version 3 of the License, or                   *
	*	(at your option) any later version.                                                 *
	*	                                                                                    *
	*	ModularWebsiteFramework is distributed in the hope that it will be useful,          *
	*	but WITHOUT ANY WARRANTY; without even the implied warranty of                      *
	*	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the                       *
	*	GNU General Public License for more details.                                        *
	*	                                                                                    *
	*	You should have received a copy of the GNU General Public License                   *
	*	along with ModularWebsiteFramework.  If not, see <http://www.gnu.org/licenses/>.    *
	****************************************************************************************/
?>
<?php
	class AuthenticationEngine {
		protected $login = NULL;
		protected $DBengine;
		
		public function __construct() {
			$this->DBengine = new DBengine();
			session_start();
			if(isset($_SESSION["login"])) $this->login = $_SESSION["login"];
			else session_destroy();
		}

		public function getInfo() {
		// Merge Information from ALL of user table and return it as array
		
			if($this->login != NULL) {
				if($this->DBengine->query("SELECT `user_id`,`username`,`name`,`surname` FROM `user` WHERE MD5(`user_id`) = MD5(?)",
					array(
							array("s", $this->login)
					)
				)) $result = $this->DBengine->getResult();
				if(mysqli_num_rows($result) === 1) {
					$result = mysqli_fetch_array($result);
					$return["user_id"] = str_pad(strval($result["user_id"]), 15, '0', STR_PAD_LEFT);
					$return["username"] = $result["username"];
					$return["name"] = $result["name"];
					$return["surname"] = $result["surname"];
				} else {
					$return = FALSE;
				}
				
				if($this->DBengine->query("SELECT `email`,`phone`,`mobile`,`address` FROM `user_info` WHERE MD5(`user_id`) = MD5(?)",
					array(
							array("s", $this->login)
					)
				)) $result = $this->DBengine->getResult();
				if(mysqli_num_rows($result) === 1) {
					$result = mysqli_fetch_array($result);
					$return["email"] = $result["email"];
					$return["phone"] = $result["phone"];
					$return["mobile"] = $result["mobile"];
					$return["address"] = $result["address"];
				} else {
					$return = FALSE;
				}
				
			} else {
				$return = FALSE;
			}
			return $return;
		}
		
		public function Login($username, $password) {
			if(isset($this->login)) return FALSE;
			$input["username"] = $this->mkuser($username);
			$input["password"] = $this->mkpass($username, $password);
			if($this->DBengine->query("SELECT * FROM `user` WHERE TO_BASE64(`username`) = ?",
				array(
						array("s", $input["username"])
				)
			)) $result = $this->DBengine->getResult();
			if(mysqli_num_rows($result) === 1) {
				$result = mysqli_fetch_array($result);
				if(
					($this->mkuser($result["username"]) == $input["username"]) && 
					($result["password"] == $input["password"])
				) {
					session_start();
					$this->login = str_pad(strval($result["user_id"]), 15, '0', STR_PAD_LEFT);
					$_SESSION["login"] = $this->login;
					$this->log("User ".$username." Login Success");
					return TRUE;
				} else {
					$this->log("User ".$username." Login Failed (Invalid Password)");
					return FALSE;
				}
			} else {
				$this->log("User ".$username." Login Failed (Not Exist)");
				return FALSE;
			}
		}
		
		public function Logout() {
			$this->log("User Logout");
			if(isset($this->login)) {
				$this->login = NULL;			// Clear Authentication Data
				$_SESSION["login"] = NULL;		
				session_destroy();				// Destroy Session
			}
		}
		
		public function Register($user_input) {
			if(isset($this->login)) return FALSE;
			// Validate & Process User Input
				$input["username"] = $this->mkuser($user_input["username"]);
				$input["password"] = $this->mkpass($user_input["username"], $user_input["password"]);
				$input["name"] = base64_encode($user_input["fname"]);
				$input["surname"] = base64_encode($user_input["lname"]);
				$input["email"] = base64_encode($user_input["email"]);
				$input["phone"] = base64_encode($user_input["phone"]);
				$input["mobile"] = base64_encode($user_input["mobile"]);
				$input["address"] = base64_encode($user_input["address"]);
				
				if(strlen($input["phone"]) 		> 64) 		return FALSE;
				if(strlen($input["mobile"]) 	> 64) 		return FALSE;
				if(strlen($input["username"]) 	> 128) 		return FALSE;
				if(strlen($input["password"]) 	> 128) 		return FALSE;
				if(strlen($input["name"]) 		> 256) 		return FALSE;
				if(strlen($input["surname"]) 	> 256) 		return FALSE;
				if(strlen($input["email"]) 		> 256) 		return FALSE;
				if(strlen($input["address"]) 	> 4096) 	return FALSE;
				
			// Check If Username Exist
			if($this->isExist($input["username"])) return FALSE;
			
			// Insert Into Database
			$main_data = $this->DBengine->query("INSERT INTO `user`(`username`, `password`, `name`, `surname`) VALUES (FROM_BASE64(?), ?, FROM_BASE64(?), FROM_BASE64(?))",
				array(
						array("s", $input["username"]),
						array("s", $input["password"]),
						array("s", $input["name"]),
						array("s", $input["surname"])
				)
			);
			if($main_data) { // If Main Insert Success, Get UID from Main and Insert Into Sub Data
				if($this->isExist($input["username"])){	// Always TRUE
					$userid = $this->getUserID($input["username"]);
					$sub_data  = $this->DBengine->query("INSERT INTO `user_info`(`user_id`, `email`, `phone`, `mobile`, `address`) VALUES (?, ?, ?, ?, ?)",
						array(
							array("i", $userid),
							array("s", $input["email"]),
							array("s", $input["phone"]),
							array("s", $input["mobile"]),
							array("s", $input["address"])
						)
					);
				}
			}
			
			if($main_data && $sub_data) return TRUE;
			else {
				if($main_data) $this->DBengine->query("DELETE FROM `user` WHERE TO_BASE64(`username`) = ?",
					array(
						array("s", $input["username"])
					)
				);
				return FALSE;
			}
		}
		
		public function updateUserInfo($update_data) {
			if($this->isHasPrivilege(1)) {
				$user_id = $this->login;
				if(!(is_numeric($user_id) && is_array($update_data))) return FALSE;
				$allowed_update1 = array(
					array("s", "name", "none"),
					array("s", "surname", "none"),
				);
				$allowed_update2 = array(
					array("s", "email", "b64"),
					array("s", "phone", "b64"),
					array("s", "mobile", "b64"),
					array("s", "address", "b64")
				);
				$userquery = array(" WHERE MD5(`user_id`) = MD5(?)", array("s", str_pad(strval($user_id), 15, '0', STR_PAD_LEFT)));
				$upd1 = $this->processUpdate($allowed_update1, $update_data, "UPDATE `user` SET ");
				$upd2 = $this->processUpdate($allowed_update2, $update_data, "UPDATE `user_info` SET ");
				if($upd1 != FALSE) {
					$upd1[0] .= $userquery[0];
					$upd1[1][] = $userquery[1];
					$upd1 = $this->DBengine->query($upd1[0], $upd1[1]);
					if(!$upd1) return FALSE;
				}
				if($upd2 != FALSE) {
					$upd2[0] .= $userquery[0];
					$upd2[1][] = $userquery[1];
					$upd2 = $this->DBengine->query($upd2[0], $upd2[1]);
					if(!$upd2) return FALSE;
				}
				return TRUE;
			} else return FALSE;
		}
		
		protected function processUpdate($allowed_update, $update_data, $updquery) {
			$count = 0; $upddata = array();
			foreach($allowed_update as $key) {
				if(isset($update_data[$key[1]])) {
					if($count != 0) $updquery .= ", ";
					if($key[0] == "s") {
						switch($key[2]) {
							case "none":
								$updquery .= "`".$key[1]."` = FROM_BASE64(?)";
								$upddata[] = array($key[0], base64_encode($update_data[$key[1]]));
								break;
							case "b64":
								$updquery .= "`".$key[1]."` = ?";
								$upddata[] = array($key[0], base64_encode($update_data[$key[1]]));
								break;
							default:
								return FALSE;
								break;
						}
					} else {
						if(!is_numeric($update_data[$key[1]])) return FALSE;
						$updquery .= "`".$key[1]."` = ?";
						$upddata[] = array($key[0], $update_data[$key[1]]);
					}
					$count++;
				}
			}
			if($count > 0) return array($updquery, $upddata);
			else return FALSE;
		}
		
		public function changePassword($oldpass, $newpass) {
			if($this->isHasPrivilege(1)) {
				if($this->DBengine->query("SELECT * FROM `user` WHERE MD5(`user_id`) = MD5(?)",
					array(
							array("s", str_pad(strval($this->login), 15, '0', STR_PAD_LEFT))
					)
				)) $result = $this->DBengine->getResult();
				if(mysqli_num_rows($result) === 1) {
					$result = mysqli_fetch_array($result);
					if($result["password"] == $this->mkpass($result["username"] ,$oldpass)) {
						// Update Password in Database
						if($this->DBengine->query("UPDATE `user` SET `password` = ? WHERE MD5(`user_id`) = MD5(?)",
							array(
								array("s", $this->mkpass($result["username"] ,$newpass)),
								array("s", str_pad(strval($this->login), 15, '0', STR_PAD_LEFT))
							)
						)) {
							$this->log("User Change Password");
							return TRUE;
						}else return FALSE;
					} else return FALSE;
				} else return FALSE;
			} else return FALSE;
		}
		
		protected function isExist($username) {
			if($this->DBengine->query("SELECT `user_id` FROM `user` WHERE TO_BASE64(`username`) = ?",
				array(
						array("s", $username)
				)
			)) $result = $this->DBengine->getResult();
			if(mysqli_num_rows($result) != 0) return TRUE;
			else return FALSE;
		}
		
		protected function getUserID($username) {
			if($this->DBengine->query("SELECT `user_id` FROM `user` WHERE TO_BASE64(`username`) = ?",
				array(
						array("s", $username)
				)
			)) $result = $this->DBengine->getResult();
			if(mysqli_num_rows($result) != 0) {
				$return = mysqli_fetch_array($result);
				return $return["user_id"];
			}
			else return FALSE;
		}
		
		public function isHasPrivilege($priv_id) {
			if($this->login != NULL) {
				if($this->DBengine->query("SELECT `user_priv` FROM `user` WHERE MD5(`user_id`) = MD5(?)",
					array(
							array("s", $this->login)
					)
				)) $result = $this->DBengine->getResult();
				if(mysqli_num_rows($result) === 1) {
					$result = mysqli_fetch_array($result);
					if($this->DBengine->query("SELECT `priv_list` FROM `user_priv` WHERE `user_priv_id` = ?",
						array(
								array("i", $result["user_priv"])
						)
					)) $result = $this->DBengine->getResult();
					if(mysqli_num_rows($result) === 1) {
						$result = mysqli_fetch_array($result);
						if((decbin(floatval($result["priv_list"]) & floatval($priv_id))) == decbin(floatval($priv_id))) return TRUE;
						else return FALSE;
					} else return FALSE;
				} else return FALSE;
			} else return FALSE;
		}
		
		public function isLoggedIn() {
			if(isset($this->login)) return TRUE;
			else return FALSE;
		}
		
		protected function mkuser($username) {
			return base64_encode($username);
		}
		
		protected function mkpass($username, $password) {
			return hash("SHA512",base64_encode($username).$password);
		}
		
		public function log($message) {
			$currentUser = $this->getInfo();
			if(!$currentUser) $currentUser = "-1";
			else $currentUser = $currentUser["user_id"];
			
			$message = base64_encode($message);
			
			$result = $this->DBengine->query("INSERT INTO `log` (`user_id`, `ip`, `message`, `time`) VALUES (?, ?, ?, ".time().")",
				array(
					array("i", $currentUser),
					array("s", $_SERVER["REMOTE_ADDR"]),
					array("s", $message)
				)
			);
			if($result)	return TRUE;
			else return FALSE;
		}
		
		public function ip_ver($ipaddr) {
			if(preg_match("/^(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}/", $ipaddr)) return 4;
			else return 6;
		}
	}
?>