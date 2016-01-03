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
			$this->Authen = new ExtendedAuthenticationEngine();
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
			return $success[0][0];
		}
		
		public function delPost($PostID) {
			$success = $this->DB->query("DELETE FROM BLOG_POST WHERE POST_ID = ?",
				array(
					array("i", $PostID)
				)
			);
			
			return $success[0][0];
		}
		
		public function getPost($PostID) {
			
			$res = $this->DB->query("SELECT * FROM BLOG_POST WHERE POST_ID = ?",
				array(
					array("i", $PostID)
				)
			);
			
			return new PostData($res[0]["POST_ID"], $res[0]["POST_TITLE"], $res[0]["POST_DATA"], $res[0]["USER_ID"]);
		}
		
		public function setPost($PostData) {
			$success = $this->DB->query("UPDATE BLOG_POST SET POST_TITLE = ?, POST_DATA = ? WHERE POST_ID = ?",
				array(
					array("s", $PostData->getPostTitle()),
					array("s", $PostData->getPostData()),
					array("i", $PostData->getPostID())
				)
			);
			
			return $success[0][0];
		}
		
		public function getOwnPostRange($start, $length) {
			$LoginData = $this->Authen->getLoginData();
			$res = $this->DB->query("SELECT * FROM BLOG_POST WHERE USER_ID = ? ORDER BY POST_ID DESC LIMIT ?, ?",
				array(
					array("i", $LoginData["USER_ID"]),
					array("i", $start),
					array("i", $length)
				)
			);
			return $res;
		}
		
		public function getOwnPostCount() {
			$LoginData = $this->Authen->getLoginData();
			$res = $this->DB->query("SELECT POST_ID FROM BLOG_POST WHERE USER_ID = ?",
				array(
					array("i", $LoginData["USER_ID"])
				)
			);
			return count($res);
		}
		
		public function getPostRange($start, $length) {
			$res = $this->DB->query("SELECT * FROM BLOG_POST ORDER BY POST_ID DESC LIMIT ?, ?",
				array(
					array("i", $start),
					array("i", $length)
				)
			);
			return $res;
		}
		
		public function getPostCount() {
			return count($this->DB->query("SELECT POST_ID FROM BLOG_POST"));
		}
	}
?>