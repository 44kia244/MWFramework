<!DOCTYPE html>
<html>
<head>
	<title>Search</title>
	<meta charset="UTF-8">
	<style>
		<?php MWF_ViewLoader::Load("mod_core_design", "base_css");?>
	</style>
</head>
<body>
	<?php MWF_ViewLoader::Load("mod_core_design", "headerbar"); ?>
	<div id="searchbox">
	<form method="POST">
	<input type="text" name="product" placeholder="Enter Product Name" />
	<input type="submit" value="Search" />
	</div>
	<hr />
	<div id="searchvalue">
	<?php
		if(empty($_POST["product"]) || !isset($_POST["product"])){
			die("<span>Please Enter Product Name</span>");
		}
		$db = new DBEngine();
		$value = $db->query("SELECT ?,?,? FROM PRODUCTS WHERE PROD_NAME LIKE %?%",
			array(
				array("")
			)
		);
	?>
	</div>
</body>
</html>