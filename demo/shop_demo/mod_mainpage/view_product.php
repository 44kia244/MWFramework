<!DOCTYPE html>
<html>
	<head>
		<title><?php echo BaseConfiguration::$WebName . " - Product Detail"; ?></title>
		<meta charset="UTF-8">
		<style>
			<?php MWF_ViewLoader::Load("mod_core_design", "base_css");?>
		</style>
	</head>
	<body>
		<?php MWF_ViewLoader::Load("mod_core_design", "headerbar"); ?>
		<h1>Shop Demo Product Detail Page</h1> 
		
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
				<h3>Price : <?php echo htmlspecialchars(sprintf("%.2f THB", $res->getProductPRICE())); ?></h3>
				<p><?php echo htmlspecialchars($res->getProductDesc()); ?></p>
			</div>
		</div>
	</body>
</html>