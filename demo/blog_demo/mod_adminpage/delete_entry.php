<!DOCTYPE html>
<html>
	<head>
		<title>Delete Blog Entry</title>
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
		<form action="?mod=mod_adminpage&view=delete_entry_action" method="POST">
			<p>Are you sure to Delete Post #<?php echo $data->getPostID(); ?></p>
			<input type="button" value="Cancel" onClick="javascript:history.back(1);" />
			<input type="submit" value="Confirm Delete" />
			<input type="hidden" name="POST_ID" value="<?php echo $data->getPostID(); ?>" />
		</form>
		<div class="blog_post">
			<h3><?php echo $data->getPostTitle(); ?></h3>
			<p><?php echo $data->getPostData(); ?></p>
		</div>
	</body>
</html>