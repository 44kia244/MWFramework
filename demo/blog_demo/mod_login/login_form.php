<?php
	$target = $_GET["t_mod"] !== "" ? "?mod=" . $_GET["t_mod"] . ($_GET["t_view"] !== "" ? "&view=" . $_GET["t_view"] : "") : ".";
	/* if($_GET["t_mod"] !== "") {
		$target = "?mod=" . $_GET["t_mod"];
		if($_GET["t_view"] !== "") {
			$target = $target . "&view=" . $_GET["t_view"];
		}
	} else {
		$target = ".";
	} */
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<meta charset="UTF-8">
	<!-- <link rel="stylesheet" type="text/css" href="?mod=mod_login&view=login_css" /> -->
	<style>
		<?php MWF_ViewLoader::Load("mod_core_design", "base_css");?>
	</style>
</head>
<body>
	<?php MWF_ViewLoader::Load("mod_core_design", "headerbar"); ?>
	<h2>Login Form</h2>
	<form action="?mod=mod_login&view=login_action" method="POST">
	<div id="container">
		<input type="text" name="username" placeholder="Username" />
		<input type="password" name="password" placeholder="Password" />
		<input type="hidden" name="targetpage" value="<?php echo $target; ?>" />
		<input type="submit" value="Login" />
		<?php if($_GET["loginfail"] == 1) { ?>
			<h4 style="color: red;">Invalid Login</h4>
		<?php } ?>
	</div>
	</form>
	<hr>
	<a href="?mod=mod_login&view=forgetpassword_form">Forget Password</a> <!-- Link to password reset page -->
</body>
</html>