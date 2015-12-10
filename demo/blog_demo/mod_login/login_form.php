<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="/?mod=mod_login&view=login_css" />
</head>
<body>
	<h2>Login Form</h2>
	<form action="/?mod=mod_login&view=login_action" method="POST">
	<div id="container">
		<input type="text" name="username" placeholder="Username">
		<input type="password" name="password" placeholder="Password">
		<?php if($_GET["loginfail"] == 1) { ?>
			<h4 style="color: red;">Invalid Login</h4>
		<?php } ?>
		<input type="submit" value="Login">
	</div>
	</form>
	<hr>
	<a href="#">Forget Password</a> <!-- Link to password reset page -->
</body>
</html>