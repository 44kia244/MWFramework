<!DOCTYPE html>
<html>
<head>
	<title>Reset Password</title>
	<meta charset="UTF-8">
	<style>
		<?php //MWF_ViewLoader::Load("mod_login", "forgetpassword_css"); ?> <!-- Disable due to PHP Error If you can't see the error please view page source-->
	</style>
</head>
<body>
	<h2>Reset Password Form</h2>
	<form action="?mod_login&view=forgetpassword_action" method="POST">
	<div id="container">
		<input type="text" name="email" placeholder="E-mail" />
		<input type="submit" value="Send">
	</div>
	</form>
</div>
</body>
</html>