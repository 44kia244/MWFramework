<?php $Authen = new ExtendedAuthenticationEngine(); ?>
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
		<?php MWF_ViewLoader::Load("mod_core_design", "headerbar"); ?>
<?php
	$E = new BlogEngine();
	if(!isset($_GET["page"])) $page = 1;
	else $page = $_GET["page"];
	
	if(!isset($_GET["per_page"])) $per_page = 5;
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
		<ul class="tabs dark15">
		<?php if($page > 1) { ?><li><a href="?page=<?php echo $page-1; ?>&per_page=<?php echo $per_page; ?>">&lt;</a></li><?php } ?>
<?php
	$count = ceil($E->getPostCount() / $per_page);
	for( $i = 1; $i <= $count && $i <= 10; $i++) {
?>
	<li><a href="?page=<?php echo $i; ?>&per_page=<?php echo $per_page; ?>"><?php echo $i; ?></a></li>
<?php
	}
?>
<?php if($page < $count) { ?><li><a href="?page=<?php echo $page+1; ?>&per_page=<?php echo $per_page; ?>">&gt;</a></li><?php } ?>
		</ul>
	</body>
</html>