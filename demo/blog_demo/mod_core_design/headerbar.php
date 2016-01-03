<?php
	if(isset($Authen)) $_VARIABLE_TMP = $Authen;
	$Authen = new ExtendedAuthenticationEngine();
?>
<div class="headerbar">
	<ul class="tabs">
		<li><a href=".">Main Page</a></li>
		<?php if(!$Authen->isLoggedIn()) { ?>
			<li><a href="?mod=mod_login">Login</a></li>
		<?php } else { ?>
			<li><a href="?mod=mod_adminpage"><?php $data = $Authen->getLoginData(); echo $data["NAME"] . " " . $data["SURNAME"]; ?></a></li>
			<!-- <li><a href="#">My Profile</a></li> -->
			<li><a href="?mod=mod_login&view=logout">Logout</a></li>
		<?php } ?>
	</ul>
</div>
<?php
	if(isset($_VARIABLE_TMP)) {
		$Authen = $_VARIABLE_TMP;
		unset($_VARIABLE_TMP);
	}
?>