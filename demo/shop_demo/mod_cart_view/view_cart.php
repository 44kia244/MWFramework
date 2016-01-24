<!DOCTYPE html>
<html>
	<head>
		<title><?php echo BaseConfiguration::$WebName . " - View Cart"; ?></title>
		<meta charset="UTF-8">
		<style>
			<?php MWF_ViewLoader::Load("mod_core_design", "base_css");?>
		</style>
	</head>
	<body onload="ReloadCart()">
		<?php MWF_ViewLoader::Load("mod_core_design", "headerbar"); ?>
		<h1>View Cart</h1> 
		<table class="fulltbl dark15" id="ListTable">
			<thead>
				<tr>
					<th style="width: 60%">PRODUCT NAME</th>
					<th style="width: 10%">PRICE</th>
					<th style="width: 10%">QTY</th>
					<th style="width: 10%">ONE MORE</th>
					<th style="width: 10%">ONE LESS</th>
					<th style="width: 10%">REMOVE</th>
					
				</tr>
			</thead>
			<tbody>
			
			</tbody>
		</table>
		<p class="align_right">
			<a href="javascript:void(0)" onclick="ClearCart()" >Clear Cart</a>
		</p>
		<script type="text/javascript" src="?mod=mod_cart_view&view=cart_js"></script>
	</body>
</html>