<!DOCTYPE html>
<html>
	<head>
		<title><?php echo BaseConfiguration::$WebName . " - Product Detail"; ?></title>
		<meta charset="UTF-8">
		<style>
			<?php MWF_ViewLoader::Load("mod_core_design", "base_css");?>
		</style>
		<script type="text/javascript">
			function AddToCart(pid) {
				var e = new XMLHttpRequest();
				e.onreadystatechange = function() {
					if(e.readyState == 4 && e.status == 200) {
						var data = JSON.parse(e.responseText);
						
						if(data["success"] == false) {
							alert("ACTION FAILED !");
						} else {
							document.getElementById("AddToCart_Link").remove();
						}
					}
				}
				
				e.open("GET", "?mod=mod_cart_view&view=add&id=" + pid + "&qty=1", true);
				e.send();
			}
			
			function InitialCheck(pid) {
				var ee = new XMLHttpRequest();
				ee.onreadystatechange = function() {
					if(ee.readyState == 4 && ee.status == 200) {
						var data = JSON.parse(ee.responseText);
						
						if(data[0] == true) {
							document.getElementById("AddToCart_Link").remove();
						}
					}
				}
				
				ee.open("GET", "?mod=mod_cart_view&view=isInCart&id=" + pid, true);
				ee.send();
			}
		</script>
	</head>
	<body onload="InitialCheck(<?php echo $_GET["id"]; ?>)">
		<?php MWF_ViewLoader::Load("mod_core_design", "headerbar"); ?>
		<h1>Product Detail</h1> 
		
		<div id="ProductBox">
			<?php
				$E = new ShopEngine();
				$res = $E->getProductDetails($_GET["id"]);
			?>
			<div id="ProductInfo">
				<h2><?php echo htmlspecialchars($res->getProductName()); ?></h2>
				<?php
					$pics = $res->getProductPICS();
					foreach($pics as $ppic) {
				?>
				<img src="<?php echo $ppic; ?>" />
				<?php } ?>
				<h3>
				Price : <?php echo htmlspecialchars($res->getProductPRICE()); ?> THB<br />
				<a href="javascript:void(0)" onclick="AddToCart(<?php echo $res->getProductID(); ?>)" id="AddToCart_Link">Add to Cart</a></h3>
				<p><?php echo htmlspecialchars($res->getProductDesc()); ?></p>
			</div>
		</div>
	</body>
</html>