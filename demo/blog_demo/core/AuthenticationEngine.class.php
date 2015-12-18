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
				$search = $search[0];
				if($search["USER_USERNAME"] === $this->mkusername($username) && $search["USER_PASSWORD"] === $this->mkpassword($password)) return TRUE;
			} return FALSE;
		}
		
		public function isLoggedIn() {
			if(!isset($_SESSION["login"]) || empty($_SESSION["login"])) return FALSE;
			else return $_SESSION["login"];
		}
		
		public function login($username, $password) {
			if($this->check_login($username, $password)) {
				session_start();
				$_SESSION["login"] = $this->getuserdata($username)[0];
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
			
			$result = $this->DB->query("INSERT INTO `users` (`USER_USERNAME`, `USER_PASSWORD`) VALUES (?, ?)",
				array(
					array("s", $this->mkusername($username)),
					array("s", $this->mkpassword($username, $password))
				)
			);
			
			return $result;
		}
		
		public function getuserdata($username) {
			return $this->DB->query("SELECT * FROM `users` WHERE `USER_USERNAME` = ?",
				array(
					array("s", $this->mkusername($username))
				)
			);
		}
		
		public function changepassword($username, $password, $newpassword) {
			if($this->check_login($username, $password)) {
				return $this->DB->query("UPDATE `users` SET `USER_PASSWORD` = ? WHERE `USER_USERNAME` = ?",
					array(
						array("s", $this->mkusername($username)),
						array("s", $this->mkpassword($username, $newpassword))
					)
				);
			} return FALSE;
		}
		
		private function mkusername($username) {
			return $username;
		}
		
		private function mkpassword($username, $password) {
			return hash("SHA512", $this->mkusername($username) . $password);
		}
		
		public function getLoginData() {
			return empty($this->login) ? array() : $this->login;
		}
		
		private function session_sync() {
			$this->login = $_SESSION["login"];
		}
	}
?>