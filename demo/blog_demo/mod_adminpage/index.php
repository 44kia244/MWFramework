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
		<a href="?mod=mod_adminpage&view=edit_entry">Edit blog entry</a>
		<hr>
		<a href="?mod=mod_adminpage&view=delete_entry">Delete blog entry</a>
	</body>
</html>