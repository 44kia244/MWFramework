<?php
	class Product {
		private $PRODUCT_ID;
		private $PRODUCT_NAME;
		private $PRODUCT_PRICE;
		private $PRODUCT_DESC;
		private $PRODUCT_PICS;
		
		public function __construct($PRODUCT_ID, $PRODUCT_NAME, $PRODUCT_PRICE, $PRODUCT_PICS, $PRODUCT_DESC = NULL) {
			$this->PRODUCT_ID = $PRODUCT_ID;
			$this->PRODUCT_NAME = $PRODUCT_NAME;
			$this->PRODUCT_PRICE = $PRODUCT_PRICE;
			$this->PRODUCT_DESC = $PRODUCT_DESC;
			$this->PRODUCT_PICS = $PRODUCT_PICS;
		}
		
		public function getProductID() { return $this->PRODUCT_ID; }
		public function getProductNAME() { return $this->PRODUCT_NAME; }
		public function getProductPRICE() { return $this->PRODUCT_PRICE; }
		public function getProductDESC() { return $this->PRODUCT_DESC; }
		public function getProductPICS() { return $this->PRODUCT_PICS; }
		
		public function setProductID($data) { $this->PRODUCT_ID = $data; }
		public function setProductNAME($data) { $this->PRODUCT_NAME = $data; }
		public function setProductPRICE($data) { $this->PRODUCT_PRICE = $data; }
		public function setProductDESC($data) { $this->PRODUCT_DESC = $data; }
		public function setProductPICS($data) { $this->PRODUCT_PICS = $data; }
	}
?>