<?php
	$E = new CartEngine();
	$res = $E->isHasItem($_GET["id"]);
	
	$arr = array(0 => FALSE);
	if($res != FALSE) {
		$arr[0] = TRUE;
	} else {
		$arr[0] = FALSE;
	}
	
	echo json_encode($arr);
?>