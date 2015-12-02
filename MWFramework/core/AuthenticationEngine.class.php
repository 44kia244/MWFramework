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
	class AuthenticationEngine {
		private $DB;
		private $login;
		
		public function __construct() {
			$this->DB = new DBengine();
			session_start();
				if(!empty($_SESSION["login"])) $this->session_sync();
				else session_destroy();
		}
		
		private function check_login($username, $password) {
			$search = $this->getuserdata($username);
			
			if(count($search) === 1) {
				if($search["username"] === $this->mkusername($username) && $search["password"] === $this->mkpassword($password)) return TRUE;
			} else return FALSE;
		}
		
		public function login($username, $password) {
			if($this->check_login($username, $password)) {
				session_start();
				$_SESSION["login"] = hash("SHA256", "#" . $username . $this->mkpassword($username, $password) . $username . "#");
				$this->session_sync();
				return TRUE;
			} else return FALSE;
		}
		
		public function logout() {
			$_SESSION["login"] = NULL;
			$this->session_sync();
			session_destroy();
		}
		
		public function register($username, $password) {
			if(count($this->getuserdata($username)) >= 1) return FALSE;
			
			$result = $this->DB->query("INSERT INTO `users` (`username`, `password`) VALUES (?, ?)",
				array(
					array("s", $this->mkusername($username)),
					array("s", $this->mkpassword($username, $password))
				)
			);
			
			return $result;
		}
		
		public function getuserdata($username) {
			return $this->DB->query("SELECT * FROM `users` WHERE `username` = ?",
				array(
					array("s", $this->mkusername($username))
				)
			);
		}
		
		public function changepassword($username, $password, $newpassword) {
			if($this->check_login($username, $password)) {
				return $this->DB->query("UPDATE `users` SET `password` = ? WHERE `username` = ?"
					array(
						array("s", $this->mkusername($username)),
						array("s", $this->mkpassword($username, $newpassword))
					)
				);
			}
		}
		
		private function mkusername($username) {
			return $username;
		}
		
		private function mkpass($username, $password) {
			return hash("SHA512", $this->mkusername($username) . $password);
		}
		
		private function session_sync() {
			$this->login = $_SESSION["login"];
		}
	}
?>