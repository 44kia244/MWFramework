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
			if(empty($_SESSION["login"]["USER_ID"])) return FALSE;	//If Not Logged in, Redirect page to login page
			$isDuplicate = $this->isHasItem($pid);
			if(empty($isDuplicate)) {
				$success = $this->DB->query("INSERT INTO cart (USER_ID, PROD_ID, QTY) VALUES (?, ?, ?)",
					array(
						array("i",$_SESSION["login"]["USER_ID"]),
						array("i",$pid),
						array("i",$qty)
					)
				);
				return $success[0][0];
			} else {
				return $this->editCart($pid, $isDuplicate + $qty);
			}
		}
		
		public function editCart($pid,$qty) {
			if(empty($_SESSION["login"]["USER_ID"])) return FALSE;	//If Not Logged in, Redirect page to login page
			if($qty === 0) return $this->delItemCart($pid);
			
			$success = $this->DB->query("UPDATE cart SET QTY = ? WHERE USER_ID = ? AND PROD_ID = ?",
				array(
					array("i",$qty),
					array("i",$_SESSION["login"]["USER_ID"]),
					array("i",$pid)
				)
			);
			
			return $success[0][0];
		}
		
		public function delItemCart($pid){
			if(empty($_SESSION["login"]["USER_ID"])) return FALSE;	//If Not Logged in, Redirect page to login page
			$success = $this->DB->query("DELETE FROM cart WHERE USER_ID = ? AND PROD_ID = ?",
				array(
					array("i",$_SESSION["login"]["USER_ID"]),
					array("i",$pid)
				)
			);
			return $success[0][0];
		}
		
		public function clearCart(){
			if(empty($_SESSION["login"]["USER_ID"])) return FALSE;	//If Not Logged in, Redirect page to login page
			$success = $this->DB->query("DELETE FROM cart WHERE USER_ID = ?",
				array(
					array("i",$_SESSION["login"]["USER_ID"])
				)
			);
			return $success[0][0];
		}
		
		public function isHasItem($pid) {
			if(empty($_SESSION["login"]["USER_ID"])) return FALSE;	//If Not Logged in, Redirect page to login page
			$data = $this->DB->query("SELECT QTY FROM cart WHERE USER_ID = ? AND PROD_ID = ?",
				 array(
					array("i",$_SESSION["login"]["USER_ID"]),
					array("i",$pid)
				)
			);
			
			if(count($data) == 0) return FALSE;
			return $data[0]["QTY"];
		}
		
		public function viewCart(){
			if(empty($_SESSION["login"]["USER_ID"])) return FALSE;	//If Not Logged in, Redirect page to login page
			$data = $this->DB->query("SELECT PROD_ID,QTY FROM cart WHERE USER_ID = ?",
				array(
					array("i",$_SESSION["login"]["USER_ID"])
				)
			);
			return $data;
		}
}
?>