<?php
	/*
	*  Cart Engine Controller Class
	*    - DBengine Required
	*    - AuthenticationEngine Required
	*/
	
	class CartEngine{
		private $DB;
		private $Authen;
		
		public function __construct(){
			$this->DB = new DBengine();
			$this->Authen = new AuthenticationEngine();
		}
		
		public function addToCart($pid,$qty){
			if(empty($_SESSION["login"]["USER_ID"])) return FALSE;
			//If Not Logged in, Redirect page to login page
			$success = $this->DB->query("INSERT INTO cart (USER_ID, PROD_ID, QTY) VALUES (?, ?, ?)",
				 array(
					array("i",$_SESSION["login"]["USER_ID"]),
					array("i",$pid),
					array("i",$qty)
				)
			);
			return $success[0][0];
		}
		
		public function editCart($pid,$qty){
			
		}
		
		public function delItemCart($ItemCartData){
			
		}
		
		public function viewCart(){
			if(empty($_SESSION["login"]["USER_ID"])) return FALSE;
			//No Login Data then redirect to login page
			$data = $this->DB->query("SELECT PROD_ID,QTY FROM cart WHERE USER_ID = ?",
				array(
					array("i",$_SESSION["login"]["USER_ID"])
				)
			);
			return $data;
		}
}
?>