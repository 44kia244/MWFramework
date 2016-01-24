<?php
	$E = new CartEngine();
	$ProdID = $_GET["id"];
	$ProdQty = $_GET["qty"];
	$res = $E->addToCart($ProdID, $ProdQty);
	echo json_encode(array("success" => $res));
?>