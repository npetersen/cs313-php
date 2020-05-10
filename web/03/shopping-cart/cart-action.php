<?php
	
	session_start();
	
	require_once ("Product.php");
	
	$product = new Product();
	$productArray = $product->getAllProduct();
	
	if (!empty($_POST["action"])) {
		switch($_POST["action"]) {
			case "add":
				if(!empty($_POST["quantity"])) {
					$productByCode = $productArray[$_POST["code"]];
					$itemArray = array($productByCode["code"]=>array('name'=>$productByCode["name"], 'code'=>$productByCode["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode["price"]));
					
					if(!empty($_SESSION["cart_item"])) {
						$cartCodeArray = array_keys($_SESSION["cart_item"]);
						if(in_array($productByCode["code"],$cartCodeArray)) {
							foreach($_SESSION["cart_item"] as $k => $v) {
								if($productByCode["code"] == $k) {
									$_SESSION["cart_item"][$k]["quantity"] = $_SESSION["cart_item"][$k]["quantity"]+$_POST["quantity"];
								}
							}
						} else {
							$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
						}
					} else {
						$_SESSION["cart_item"] = $itemArray;
					}
				}
			break;
			case "remove":
				if(!empty($_SESSION["cart_item"])) {
					foreach($_SESSION["cart_item"] as $k => $v) {
						if($_POST["code"] == $k) {
							unset($_SESSION["cart_item"][$k]);
						}
						if(empty($_SESSION["cart_item"])) {
							unset($_SESSION["cart_item"]);
						}
					}
				}
			break;
			case "empty":
				unset($_SESSION["cart_item"]);
			break;
		}
	}

?>

<?php if(isset($_SESSION["cart_item"])) { $item_total = 0; ?>

	<table class="table table-striped table-bordered">
		<thead class="thead-light">
			<tr>
				<th colspan="5">Shopping Cart</th>
			</tr>
			<tr>
				<th>Name</th>
				<th>SKU</th>
				<th>Quantity</th>
				<th>Price</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($_SESSION['cart_item'] as $item) { ?>
				<tr>
					<td><strong><?php echo $item['name'] ?></strong></td>
					<td><?php echo $item['code'] ?></td>
					<td><?php echo $item['quantity'] ?></td>
					<td><?php echo '$' . $item['price'] ?></td>
					<td><button class="btn btn-primary" onclick="cartAction('remove', '<?php echo $item['code'] ?>')">Remove</button></td>
				</tr>
				<?php $item_total += ($item['price'] * $item['quantity']) ?>
			<?php } ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="2"><button class="btn btn-danger" onclick="cartAction('empty', '')">Empty Cart</button></td>
				<td>Total:</td>
				<td><?php echo '$' . number_format($item_total, 2) ?></td>
				<td><button class="btn btn-success" onclick="showCheckout()">Checkout</button></td>
			</tr>
		</tfoot>
	</table>

<?php } ?>