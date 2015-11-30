<?php
	/****************************************************************************
	*	This file is part of MWFramework.                                       *
	*	                                                                        *
	*	MWFramework is free software: you can redistribute it and/or modify     *
	*	it under the terms of the GNU General Public License as published by    *
	*	the Free Software Foundation, either version 3 of the License, or       *
	*	(at your option) any later version.                                     *
	*	                                                                        *
	*	MWFramework is distributed in the hope that it will be useful,          *
	*	but WITHOUT ANY WARRANTY; without even the implied warranty of          *
	*	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the           *
	*	GNU General Public License for more details.                            *
	*	                                                                        *
	*	You should have received a copy of the GNU General Public License       *
	*	along with MWFramework.  If not, see <http://www.gnu.org/licenses/>.    *
	****************************************************************************/
?>
<?php
	/*
		Extended Engine for Privilege Action
	*/
	class PrivilegeAuthenticationEngine extends AuthenticationEngine {
		public function __construct() {
			parent::__construct();
		}
		
		public function ChangePrivilege($user_id, $user_priv_id) { 
			if($this->isHasPrivilege(2147483648)) {
				if(!(is_numeric($user_id) && is_numeric($user_priv_id))) return FALSE;	// Security Re-Check
				if($this->DBengine->query("UPDATE `user` SET `user_priv` = ? WHERE MD5(`user_id`) = ?",
					array(
						array("i", intval($user_priv_id)),
						array("s", MD5(str_pad(strval($user_id), 15, '0', STR_PAD_LEFT)))
					)
				)) return TRUE;
				else return FALSE;
			} else return FALSE;
		}
		
		public function getAllUser($per_page, $page) {
			if($this->isHasPrivilege(2147483648)) {
				if(!(is_numeric($per_page) && is_numeric($page))) return FALSE;	// Security Re-Check
				$offset = ($page-1)*$per_page;
				if($this->DBengine->query("SELECT * FROM `user` LIMIT ? OFFSET ?",
					array(
						array("i", $per_page+1),
						array("i", $offset)
					)
				)) $result = $this->DBengine->getResult();
				if(mysqli_num_rows($result) > 0) {
					$return = array();
					while($record = mysqli_fetch_array($result)) {
						$return[] = array(
							"user_id" => $record["user_id"],
							"username" => $record["username"],
							"name" => $record["name"],
							"surname" => $record["surname"]
						);
					} 
					if(mysqli_num_rows($result) > $per_page) unset($return[$per_page]);
					$return[] = "";
					if(mysqli_num_rows($result) > $per_page) $return[count($return)-1] .= "N";
					if($offset != 0) $return[count($return)-1] .= "P";
					return $return;
				} else return array();
			} else return FALSE;
		}
		
		public function listPrivilege() {
			if($this->isHasPrivilege(2147483648)) {
				if($this->DBengine->query("SELECT * FROM `user_priv`")) $result = $this->DBengine->getResult();
				if(mysqli_num_rows($result) > 0) {
					$return = array();
					while($record = mysqli_fetch_array($result)) {
						$return[] = array(
							"user_priv_id" => $record["user_priv_id"],
							"user_priv_name" => $record["user_priv_name"]
						);
					}
					return $return;
				} else return array();
			} else return FALSE;
		}
		
		public function getUserInfo($user_id) {
			if($this->isHasPrivilege(2)) {
				$user_id = str_pad(strval($user_id), 15, '0', STR_PAD_LEFT);
				if($this->DBengine->query("SELECT `user_id`,`username`,`name`,`surname`,`user_priv` FROM `user` WHERE MD5(`user_id`) = MD5(?)",
					array(
							array("s", $user_id)
					)
				)) $result = $this->DBengine->getResult();
				if(mysqli_num_rows($result) === 1) {
					$result = mysqli_fetch_array($result);
					$return["user_id"] = str_pad(strval($result["user_id"]), 15, '0', STR_PAD_LEFT);
					$return["username"] = $result["username"];
					$return["name"] = $result["name"];
					$return["surname"] = $result["surname"];
					$return["user_priv"] = $result["user_priv"];
				} else {
					$return = FALSE;
				}
				
				if($this->DBengine->query("SELECT `email`,`phone`,`mobile`,`address` FROM `user_info` WHERE MD5(`user_id`) = MD5(?)",
					array(
							array("s", $user_id)
					)
				)) $result = $this->DBengine->getResult();
				if(mysqli_num_rows($result) === 1) {
					$result = mysqli_fetch_array($result);
					$return["email"] = base64_decode($result["email"]);
					$return["phone"] = base64_decode($result["phone"]);
					$return["mobile"] = base64_decode($result["mobile"]);
					$return["address"] = base64_decode($result["address"]);
				} else {
					$return = FALSE;
				}
				
			} else {
				$return = FALSE;
			}
			return $return;
		}
		
		protected function getPrivilegeName($priv_id) {
			if($this->isHasPrivilege(2)) {
				if($this->DBengine->query("SELECT `user_priv_name` FROM `user_priv` WHERE `user_priv_id` = ?",
					array(
						array("i", $priv_id)
					)
				)) $result = $this->DBengine->getResult();
				if(mysqli_num_rows($result) === 1) {
					$record = mysqli_fetch_array($result);
					return $record["user_priv_name"];
				} else return $priv_id;
			} else return FALSE;
		}
		
		public function updateUserInfo($user_id, $update_data) {
			if($this->isHasPrivilege(2147483648)) {
				if(!(is_numeric($user_id) && is_array($update_data))) return FALSE;
				if(intval($user_id) == intval($this->login)) {
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
				} else {
					$allowed_update1 = array(
						array("s", "name", "none"),
						array("s", "surname", "none"),
						array("i", "user_priv", "none")
					);
					$allowed_update2 = array(
						array("s", "email", "b64"),
						array("s", "phone", "b64"),
						array("s", "mobile", "b64"),
						array("s", "address", "b64")
					);
				}
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
		
		public function removeUser($user_id) {
			if($this->isHasPrivilege(2147483648)) {
				if(!is_numeric($user_id)) return FALSE;
				$user_id = str_pad(strval($user_id), 15, '0', STR_PAD_LEFT);
				if($this->DBengine->query("DELETE FROM `user_info` WHERE MD5(`user_id`) = MD5(?)",
					array(
						array("s", $user_id)
					)
				)) if($this->DBengine->query("DELETE FROM `user` WHERE MD5(`user_id`) = MD5(?)",
					array(
						array("s", $user_id)
					)
				)) return TRUE;
				return FALSE;
			} else return FALSE;
		}
	}
?>