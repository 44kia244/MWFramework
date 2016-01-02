<!DOCTYPE html>
<html>
	<head>
		<title><?php echo BaseConfiguration::$WebName . " - Main Page"; ?></title>
		<meta charset="UTF-8">
		<style>
			<?php MWF_ViewLoader::Load("mod_mainpage", "default_css");?>
		</style>
	</head>
	<body>
<?php
	$E = new BlogEngine();
	if(!isset($_GET["page"])) $page = 1;
	else $page = $_GET["page"];
	
	if(!isset($_GET["per_page"])) $per_page = 30;
	else $page = $_GET["per_page"];
	
	$start = ($page-1) * $per_page;
	
	$res = $E->getPostRange($start, $per_page);
	
	echo "<table>";
	for($i=0;$i<count($res);$i++) {
		echo "<tr>";
		foreach($res[$i] as $val) {
			echo "<td>";
			 echo htmlspecialchars($val);
			echo "</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
?>
	</body>
</html>