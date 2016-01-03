<!DOCTYPE html>
<html>
	<head>
		<title>Edit Blog Entry</title>
		<meta charset="UTF-8" />
		<style>
			<?php MWF_ViewLoader::Load("mod_core_design", "base_css");?>
		</style>
	</head>
	<body>
		<?php MWF_ViewLoader::Load("mod_core_design", "headerbar"); ?>
		<?php
			$E = new BlogEngine();
			$post = $E->getPost($_POST["POST_ID"]);
			$post->setPostTitle($_POST["title"]);
			$post->setPostData($_POST["data"]);
			$data = $E->setPost($post);
			
			if($data) header("Location: ?mod=mod_adminpage");
			else echo "Edit Post Failed";
		?>
	</body>
</html>