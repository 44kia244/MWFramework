<!DOCTYPE html>
<html>
	<head>
		<title>Edit Blog Entry</title>
		<meta charset="UTF-8">
		<style>
			<?php MWF_ViewLoader::Load("mod_adminpage", "edit_entry_css");?>
		</style>
	</head>
	<body>
		<h1>Edit Blog Entry</h1>
		<form action="?mod=mod_adminpage&view=edit_entry_action" method="POST">
		<h3>Blog Title</h3>
		<input type="text" name="title" value="<?php //Title from query via blogengine?>">
		<h3>Blog Data</h3>
		<textarea rows="10" cols="100" name="data"> <?php //Data from query via blogengine ?> </textarea>
		<br/>
		<input type="submit">
	</body>
</html>