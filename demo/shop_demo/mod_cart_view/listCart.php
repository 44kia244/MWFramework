<?php
	$E = new CartEngine();
	$res = $E->viewCart();
	
	$arr = array("success" => FALSE);
	if($res != FALSE) {
		$arr["success"] = TRUE;
		$arr = array_merge($arr,$res);
	} else {
		$arr["success"] = $res;
	}
	
	echo json_encode($res);
?>