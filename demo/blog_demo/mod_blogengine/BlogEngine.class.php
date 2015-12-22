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
			// Get Login Data from AuthenticationEngine
			$LoginData = $this->Authen->getLoginData();
			// If Not Logged In, Exit with FAILURE
			if(empty($LoginData)) return FALSE;
			// Assign UserID Tag for New Post
			$PostData->setPostOwner($LoginData["USER_ID"]);
			// Query : Insert New Post into Database
			$success = $this->DB->query("INSERT INTO BLOG_POST (POST_TITLE, POST_DATA, USER_ID) VALUES (?, ?, ?)",
				array(
					array("s", $PostData->getPostTitle()),
					array("s", $PostData->getPostData()),
					array("i", $PostData->getPostOwner())
				)
			);
			// Return Success or Failure
			return $success[0];
		}
		
		public function delPost($PostID) {
			$success = $this->DB->query("DELETE FROM BLOG_POST WHERE POST_ID = ?",
				array(
					array("i", $PostID)
				)
			);
			
			return $success[0];
		}
		
		public function getPost($PostID) {
			$res = $this->DB->query("SELECT * FROM BLOG_POST WHERE POST_ID = ?",
				array(
					array("i", $PostID)
				)
			);
			
			return new PostData($res[0]["POST_ID"], $res[0]["POST_TITLE"], $res[0]["POST_DATA"], $res[0]["USER_ID"]);
		}
		
		public function setPost($PostID, $PostData) {
			
		}
		
		public function getOwnPostRange($start, $length) {
			$last = $length + $start;
			$res = $this->DB->query("SELECT * FROM BLOG_POST WHERE USER_ID = ? LIMIT ?, ?",
				array(
					array("i",), //Can't find function that return USER_ID
					array("i",$start),
					array("i",$last)
				)
			);
		}
		
		public function getPostRange($start, $length) {
			$last = $length + $start;
			$res = $this->DB->query("SELECT * FROM BLOG_POST LIMIT ?, ?",
				array(
					array("i",$start),
					array("i",$last)
				)
			);
		}
	}
?>