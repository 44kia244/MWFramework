<?php
	$E = new CartEngine();
	$ProdID = $_GET["id"];
	$res = $E->delItemCart($ProdID);
	echo json_encode(array("success" => $res));
?>