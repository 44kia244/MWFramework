<div id="ProductBox">
			<?php
				$E = new ShopEngine();
				/*if(!isset($_GET["page"])) $page = 1;
				else $page = $_GET["page"];
				
				if(!isset($_GET["per_page"])) $per_page = 5;
				else $per_page = $_GET["per_page"];
				
				$start = ($page-1) * $per_page;*/
				$res = $E->SearchProducts($_POST["q"]);
				//$res = $E->getProductsRange($start, $per_page);
				
				foreach($res as $product) {
			?>
			<div class="product_thumbnail">
				<h6 class="pname"><?php echo htmlspecialchars($product->getProductNAME()); ?></h6>
				<img src="<?php echo $product->getProductPICS()[0]; ?>" class="ppic"/>
				<h6 class="pprice"><?php echo htmlspecialchars($product->getProductPRICE()); ?> THB</h6>
				<h6 class="INFO_LINK">
					<a href="?mod=mod_mainpage&view=view_product&id=<?php echo $product->getProductID(); ?>">MORE INFO</a>
				</h6>
			</div>
			<?php } ?>
</div>