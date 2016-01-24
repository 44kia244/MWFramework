<!DOCTYPE html>
<html>
<head>
	<title>Search</title>
	<meta charset="UTF-8">
	<style>
		<?php MWF_ViewLoader::Load("mod_core_design", "base_css");?>
	</style>
	<script type="text/javascript">
		function Search(form) {
			var SearchText = form.getElementsByTagName("input")[0].value;
			if(SearchText == "") return false;
			var ee = new XMLHttpRequest();
			ee.onreadystatechange = function() {
				if(ee.readyState == 4 && ee.status == 200) {
					//var data = JSON.parse(ee.responseText);
					var ResultBox = document.getElementById("ResultBox");

					ResultBox.innerHTML = ee.responseText;
				}
			}
			
			ee.open("POST", "?mod=mod_search&view=search_action", true);
			ee.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			ee.send("q=" + encodeURI(SearchText));
			return false;
		}
	</script>
</head>
<body>
	<?php MWF_ViewLoader::Load("mod_core_design", "headerbar"); ?>
	<h1>Search Item</h1> 
	<div id="searchbox">
		<form method="POST" onSubmit="return Search(this);">
			<input type="text" name="product" placeholder="Enter Product Name" />
			<input type="submit" value="Search" />
		</form>
	</div>
	<hr />
	<div id="ResultBox">
		
	</div>
</body>
</html>