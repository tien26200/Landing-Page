<?php
if(isset($_POST['submitSave'])) {
	$products = simplexml_load_file('data/product.xml');
	$product = $products->addChild('product');
	$product->addAttribute('id', $_POST['id']);
	$product->addChild('name', $_POST['name']);
	$product->addChild('price', $_POST['price']);
	file_put_contents('data/product.xml', $products->asXML());
	header('location:index.php');
}
?>
<form method="post">
	<table cellpadding="2" cellspacing="2">
		<tr>
			<td>Id</td>
			<td><input type="text" name="id"></td>
		</tr>
		<tr>
			<td>Name</td>
			<td><input type="text" name="name"></td>
		</tr>
		<tr>
			<td>price</td>
			<td><input type="text" name="price"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="Save" name="submitSave"></td>
		</tr>
	</table>
</form>