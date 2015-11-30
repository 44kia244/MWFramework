<!DOCTYPE html>
<html>
	<head>
		<title><?php echo Configuration::$WebName; ?></title>
		<meta charset="utf-8" />
	</head>
	<body>
<?php
	$a = new TestClass();
	$a->sayhello();
	echo "<br />";
	echo Configuration::$WebPath;
?>
	</body>
</html>