<?php
	$Authen = new ExtendedAuthenticationEngine();
	$Authen->logout();
	header("Location: .");
?>