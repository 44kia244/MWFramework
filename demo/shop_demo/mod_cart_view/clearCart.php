<?php
	$E = new CartEngine();
	$res = $E->clearCart();
	echo json_encode(array("success" => $res));
?>