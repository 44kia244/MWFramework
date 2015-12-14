<?php
	/*
	*  Data model for each blog post
	*    - Independent Class
	*    - Store each post data as object
	*/
	class PostData {
		private $POST_ID;
		private $POST_TITLE;
		private $POST_DATA;
		private $USER_ID;
		
		public function __construct($POST_ID, $POST_TITLE, $POST_DATA, $USER_ID) {
			$this->setPostID($POST_ID);
			$this->setPostTitle($POST_TITLE);
			$this->setPostData($POST_DATA);
			$this->setPostOwner($USER_ID);
		}
		
		public function getPostID() { return $this->POST_ID; }
		public function getPostTitle() { return $this->POST_TITLE; }
		public function getPostData() { return $this->POST_DATA; }
		public function getPostOwner() { return $this->USER_ID; }
		
		public function setPostID($POST_ID) { $this->POST_ID = $POST_ID; }
		public function setPostTitle($POST_TITLE) { $this->POST_TITLE = $POST_TITLE; }
		public function setPostData($POST_DATA) { $this->POST_DATA = $POST_DATA; }
		public function setPostOwner($USER_ID) { $this->USER_ID = $USER_ID; }
	}
?>