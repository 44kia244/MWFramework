<?php
	$E = new CartEngine();
	$F = new ShopEngine();
	$res = $E->viewCart();
	
	$arr = array(0 => FALSE);
	if($res != FALSE) {
		$arr[0] = TRUE;
		foreach($res as $item) {
			$item_info = $F->getProductDetails($item["PROD_ID"]);
			$tmp = array(
				"PRODUCT_ID" => $item_info->getProductID(),
				"PRODUCT_NAME" => $item_info->getProductName(),
				"PRODUCT_PRICE" => $item_info->getProductPrice(),
				"PRODUCT_QTY" => $item["QTY"]
			);
			$arr[] = $tmp;
		}
		
	} elseif($res == array()) {
		$arr[0] = TRUE;
	} else {
		$arr[0] = FALSE;
	}
	
	echo json_encode($arr);
?>