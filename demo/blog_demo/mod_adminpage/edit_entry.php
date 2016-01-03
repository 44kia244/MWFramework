<!DOCTYPE html>
<html>
	<head>
		<title>Edit Blog Entry</title>
		<meta charset="UTF-8">
		<style>
			<?php MWF_ViewLoader::Load("mod_core_design", "base_css");?>
		</style>
	</head>
	<body>
		<?php MWF_ViewLoader::Load("mod_core_design", "headerbar"); ?>
		<?php
			$E = new BlogEngine();
			$data = $E->getPost($_GET["POST_ID"]);
		?>
		<h1>Edit Blog Entry</h1>
		<form action="?mod=mod_adminpage&view=edit_entry_action" method="POST">
		<h3>Blog Title</h3>
		<input type="text" name="title" value="<?php echo $data->getPostTitle(); ?>" /><input type="hidden" name="POST_ID" value="<?php echo $data->getPostID(); ?>" />
		<h3>Blog Data</h3>
		<textarea rows="10" cols="100" name="data"><?php echo $data->getPostData(); ?></textarea>
		<br/>
		<input type="submit">
	</body>
</html>