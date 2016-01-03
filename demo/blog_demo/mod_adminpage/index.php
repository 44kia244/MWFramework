<!DOCTYPE html>
<html>
	<head>
		<title>Welcome To My Blog</title>
		<meta charset="UTF-8">
		<style>
			<?php MWF_ViewLoader::Load("mod_adminpage", "default_css");?>
		</style>
	</head>
	<body>
		<a href="?mod=mod_adminpage&view=add_entry">Create new blog entry</a>
		<hr>
<?php
	$E = new BlogEngine();
	if(!isset($_GET["page"])) $page = 1;
	else $page = $_GET["page"];
	
	if(!isset($_GET["per_page"])) $per_page = 30;
	else $per_page = $_GET["per_page"];
	
	$start = ($page-1) * $per_page;
	
	$res = $E->getPostRange($start, $per_page);
	
	echo "<table border=\"1\">";
	for($i=0;$i<count($res);$i++) {
		echo "<tr>";
		echo "<td>" . $res[$i]["POST_TITLE"] . "</td>";
		echo "<td><a href=\"?mod=mod_adminpage&view=edit_entry&POST_ID=" . $res[$i]["POST_ID"] . "\">Edit</a></td>";
		echo "<td><a href=\"?mod=mod_adminpage&view=delete_entry&POST_ID=" . $res[$i]["POST_ID"] . "\">Delete</a></td>";
		echo "</tr>";
	}
	echo "</table>";
?>
	</body>
</html>