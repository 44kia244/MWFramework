<?php
$blogengine = new BlogEngine();
$PostData = new PostData(NULL, $_POST["title"], $_POST["data"], NULL); // New Post Object with Given Data ($_POST)
$success = $blogengine->newPost($PostData);
if(!$success){
	header('Location: ?mod=mod_adminpage&view=add_entry&success=0');
}else{
	header('Location: ?mod=mod_adminpage');
}
?>