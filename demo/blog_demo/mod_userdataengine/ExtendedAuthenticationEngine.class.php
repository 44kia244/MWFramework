<?php
	class ExtendedAuthenticationEngine extends AuthenticationEngine {
		private $AuthorizationEngine;
		
		public function __construct() {
			parent::__construct();
			$this->AuthorizationEngine = new AuthorizationEngine();
		}
		
		public function isAuthorized($P_ID) {
			$login = $this->isLoggedIn();
			if(!$login) return FALSE;
			else return $AuthorizationEngine->isAuthorized($login["G_ID"], $P_ID);
		}
		
		public function getuserdata($username) {	// Override
			return $this->DB->query("SELECT * FROM USERS A JOIN USERDATA B ON(A.USER_ID = B.USER_ID) WHERE USER_USERNAME = ?",
				array(
					array("s", $this->mkusername($username))
				)
			);
		}
		
		public function register($username, $password, $name, $surname, $address, $telephone) {	// Override
			if(parent::register($username, $password)) {
				$data = parent::getuserdata($username);
				$success = $this->DB->query("INSERT INTO USERDATA VALUES (?, ?, ?, ?, ?, 2)",
					array(
						array("i", $data["USER_ID"]),
						array("s", $name),
						array("s", $surname),
						array("s", $address),
						array("s", $telephone)
					)
				);
			} else return FALSE;
		}
	}
?>