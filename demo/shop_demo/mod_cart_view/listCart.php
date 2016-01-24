<?php
	$E = new CartEngine();
	$F = new ShopEngine();
	$res = $E->viewCart();
	
	$arr = array(0 => FALSE);
	if($res != FALSE) {
		$arr[0] = TRUE;
		foreach($res as $item) {
			$item_info = $F->getProductDetails($item[0]);
			$tmp = array(
				"PRODUCT_ID" => $item_info->getProductID(),
				"PRODUCT_NAME" => $item_info->getProductName(),
				"PRODUCT_PRICE" => $item_info->getProductPrice(),
				"PRODUCT_QTY" => $item[1];
			);
			$arr[] = $tmp;
		}
		
	} else {
		$arr[0] = $res;
	}
	
	echo json_encode($res);
?>