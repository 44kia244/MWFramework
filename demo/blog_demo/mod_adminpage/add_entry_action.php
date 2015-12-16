<?php
$blogengine = new BlogEngine();
$PostData = array($_POST["title"],$_POST["data"]);
$success = $blogengine->newPost($PostData);
if(!$success){
	header('Location: ?mod=mod_adminpage&view=add_entry&success=0');
}else{
	header('Location: ?mod=mod_adminpage');
}
?>