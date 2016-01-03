<!DOCTYPE html>
<html>
	<head>
		<title>Add Entry</title>
		<meta charset="UTF-8">
		<style>
			<?php MWF_ViewLoader::Load("mod_core_design", "base_css");?>
		</style>
	</head>
	<body>
		<h1>Add Blog Entry</h1>
		<form action="?mod=mod_adminpage&view=add_entry_action" method="POST">
		<h3>Blog Title</h3>
		<input type="text" name="title">
		<h3>Blog Data</h3>
		<textarea rows="10" cols="100" name="data"></textarea>
		<br/>
		<input type="submit">
		</form>
		<?php if(isset($_GET["success"]) && $_GET["success"] == 0) { ?>
			<h4 style="color: red;">Add Entry Failed</h4>
		<?php } ?>
	</body>
</html>