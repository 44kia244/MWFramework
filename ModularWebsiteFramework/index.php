<?php
	require_once("core/ClassLoader.php");
	
	$Loader = new MWF_ViewLoader();
	$Loader->Load($_GET["mod"], $_GET["view"]);
?>