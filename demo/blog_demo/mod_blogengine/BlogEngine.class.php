<?php
	/*
	*  Blog Content Controller Class
	*    - DBengine Required
	*    - AuthenticationEngine Required
	*    - AuthorizationEngine Required
	*/
	
	class BlogEngine{
		private $DB;
		private $Authen;
		private $Authorize;
		
		public function __construct() {
			$this->DB = new DBengine();
			$this->Authen = new AuthenticationEngine();
			$this->Authorize = new AuthorizationEngine();
		}
		
		public function newPost($PostData) {
			
		}
		
		public function delPost($PostID) {
			
		}
		
		public function getPost($PostID) {
			
		}
		
		public function setPost($PostID, $PostData) {
			
		}
		
		public function getOwnPostRange($start, $length) {
			
		}
		
		public function getPostRange($start, $length) {
			
		}
	}
?>