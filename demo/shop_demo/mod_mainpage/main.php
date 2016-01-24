<!DOCTYPE html>
<html>
	<head>
		<title><?php echo BaseConfiguration::$WebName . " - Main Page"; ?></title>
		<meta charset="UTF-8">
		<style>
			<?php MWF_ViewLoader::Load("mod_core_design", "base_css");?>
		</style>
	</head>
	<body>
		<?php MWF_ViewLoader::Load("mod_core_design", "headerbar"); ?>
		<h1>Shop Demo Index Page</h1> 
		
		<div id="ProductBox">
			<?php
				$E = new ShopEngine();
				if(!isset($_GET["page"])) $page = 1;
				else $page = $_GET["page"];
				
				if(!isset($_GET["per_page"])) $per_page = 5;
				else $per_page = $_GET["per_page"];
				
				$start = ($page-1) * $per_page;
				$res = $E->getProductsRange($start, $per_page);
				
				foreach($res as $product) {
			?>
			<div class="product_thumbnail">
				<h6 class="pname"><?php echo htmlspecialchars($product->getProductNAME()); ?></h6>
				<img src="<?php echo $product->getProductPICS()[0]; ?>" class="ppic"/>
				<h6 class="pprice"><?php echo htmlspecialchars(sprintf("%.2f THB", $product->getProductPRICE())); ?></h6>
				<h6 class="INFO_LINK">
					<a href="?mod=mod_mainpage&view=view_product&id=<?php echo $product->getProductID(); ?>">MORE INFO</a>
				</h6>
			</div>
			<?php } ?>
		</div>
		
		<!-- <a href="?mod=mod_mainpage">Main Page</a><br />
		<a href="?mod=mod_login">Login Page</a><br />
		<a href="?mod=mod_search">Search Page</a><br />
		<a href="?mod=mod_cart">Cart</a> -->
	</body>
</html>