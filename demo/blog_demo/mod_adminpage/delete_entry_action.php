<?php
	$Authen = new ExtendedAuthenticationEngine();
	if(!$Authen->isAuthorized(3)) {
		header('Location: ?mod=mod_adminpage');
		die();
	}
	
	$E = new BlogEngine();
	$post = $E->getPost($_POST["POST_ID"]);
	$LoginData = $Authen->getLoginData();
	
	if($LoginData["USER_ID"] != $post->getPostOwner() && !$Authen->isAuthorized(4)) header('Location: ?mod=mod_adminpage');
	else {
		$data = $E->delPost($_POST["POST_ID"]);
		if($data) header("Location: ?mod=mod_adminpage");
		else echo "Delete Post Failed";
	}
?>
