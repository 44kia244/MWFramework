<?php
$username = $_POST["username"];
$password = $_POST["password"];
$loginengine = new ExtendedAuthenticationEngine();

if(!$loginengine->login($username,$password)) {
	header('Location: ?mod=mod_login&loginfail=1');
} else {
	if(empty($_POST["targetpage"])) $target = ".";
	else $target = $_POST["targetpage"];
	header('Location: ' . $target); //Redirect to blog main view BlogView(Vm)
}
?>