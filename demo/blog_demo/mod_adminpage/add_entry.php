<!DOCTYPE html>
<html>
	<head>
		<title>Add Entry</title>
	</head>
	<body>
		<h1>Add Blog Entry</h1>
		<form action="?mod=mod_adminpage&view=add_entry_action" method="POST">
		<h3>Blog Title</h3>
		<input type="text" name="title">
		<h3>Blog Data</h3>
		<textarea rows="10" cols="100" name="data"></textarea>
		<br/>
		<input type="submit">
		</form>
	</body>
</html>