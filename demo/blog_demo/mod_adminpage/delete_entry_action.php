<?php
	$E = new BlogEngine();
	$data = $E->delPost($_POST["POST_ID"]);
	
	if($data) header("Location: ?mod=mod_adminpage");
	else echo "Delete Post Failed";
?>
