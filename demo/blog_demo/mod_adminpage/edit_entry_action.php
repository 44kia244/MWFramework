<?php
	$Authen = new ExtendedAuthenticationEngine();
	if(!$Authen->isAuthorized(2)) {
		header('Location: ?mod=mod_adminpage');
		die();
	}
		
	$E = new BlogEngine();
	$post = $E->getPost($_POST["POST_ID"]);
	$LoginData = $Authen->getLoginData();
	
	if($LoginData["USER_ID"] != $post->getPostOwner() && !$Authen->isAuthorized(4)) header('Location: ?mod=mod_adminpage');
	else {
		$post->setPostTitle($_POST["title"]);
		$post->setPostData($_POST["data"]);
		$data = $E->setPost($post);
		
		if($data) header("Location: ?mod=mod_adminpage");
		else header("Location: ?mod=mod_adminpage&view=edit_entry&POST_ID=" . $_POST["POST_ID"]);
	}
?>