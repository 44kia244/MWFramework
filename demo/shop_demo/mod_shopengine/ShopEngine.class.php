<?php
	class ShopEngine {
		private $DB;
		
		public function __construct() {
			$this->DB = new DBengine();
		}
		
		public function getProductsRange($start, $length) {
			$data = $this->DB->query("SELECT PRODUCT_ID, PRODUCT_NAME, PRODUCT_PRICE FROM PRODUCTS LIMIT ?, ?",
				array(
					array("i", $start),
					array("i", $length)
				)
			);
			
			$result = array();
			foreach($data as $product) {
				$pics = array();
				
				$pic = $this->DB->query("SELECT PIC_URL FROM PRODUCTS_PIC WHERE PRODUCT_ID = ?",
					array(
						array("i", $product["PRODUCT_ID"])
					)
				);
				
				foreach($pic as $eachpic) {
					$pics[] = $eachpic["PIC_URL"];
				}
				
				$result[] = new Product($product["PRODUCT_ID"], $product["PRODUCT_NAME"], $product["PRODUCT_PRICE"], $pics);
			}
			
			return $result;
		}
		
		public function getProductDetails($PRODUCT_ID) {
			$product = $this->DB->query("SELECT PRODUCT_ID, PRODUCT_NAME, PRODUCT_PRICE, PRODUCT_DESC FROM PRODUCTS WHERE PRODUCT_ID = ?",
				array(
					array("i", $PRODUCT_ID)
				)
			);
			
			$product = $product[0];
			
			$pics = array();
			
			$pic = $this->DB->query("SELECT PIC_URL FROM PRODUCTS_PIC WHERE PRODUCT_ID = ?",
				array(
					array("i", $PRODUCT_ID)
				)
			);
			
			foreach($pic as $eachpic) {
				$pics[] = $eachpic["PIC_URL"];
			}
			
			return new Product($product["PRODUCT_ID"], $product["PRODUCT_NAME"], $product["PRODUCT_PRICE"], $pics, $product["PRODUCT_DESC"]);
		}
	}
?>