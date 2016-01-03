<!DOCTYPE html>
<html>
	<head>
		<title><?php echo BaseConfiguration::$WebName . " - Main Page"; ?></title>
		<meta charset="UTF-8">
		<style>
			<?php MWF_ViewLoader::Load("mod_core_design", "base_css");?>
		</style>
	</head>
	<body>
<?php
	$E = new BlogEngine();
	if(!isset($_GET["page"])) $page = 1;
	else $page = $_GET["page"];
	
	if(!isset($_GET["per_page"])) $per_page = 30;
	else $per_page = $_GET["per_page"];
	
	$start = ($page-1) * $per_page;
	
	$res = $E->getPostRange($start, $per_page);
	
	for($i=0;$i<count($res);$i++) {
?>
	<div class="blog_post">
		<h3><?php echo $res[$i]["POST_TITLE"]; ?></h3>
		<p><?php echo $res[$i]["POST_DATA"]; ?></p>
	</div>
<?php
	}
?>
	</body>
</html>