<?php
if(isset($_GET['action'])) {
	$products = simplexml_load_file('data/product.xml');
	$id = $_GET['id'];
	$index = 0;
	$i = 0;
	foreach($products->product as $product){
		if($product['id']==$id){
			$index = $i;
			break;
		}
		$i++;
	}
	unset($products->product[$index]);
	file_put_contents('data/product.xml', $products->asXML());
}

$products = simplexml_load_file('data/product.xml');
echo 'Number of products: '.count($products);
echo '<br>List Product Information';
?>
<br>
<a href="add.php">Add new product</a>
<br>
<table cellpadding="2" cellspacing="2" border="1">
	<tr>
		<th>Id</th>
		<th>Name</th>
		<th>Price</th>
		<th>Option</th>
	</tr>
	<?php foreach($products->product as $product) { ?>
	<tr>
		<td><?php echo $product['id']; ?></td>
		<td><?php echo $product->name; ?></td>
		<td><?php echo $product->price; ?></td>
		<td>
			<a href="update.php?id=<?php echo $product['id']; ?>">Edit</a> |
			<a href="index.php?action=delete&id=<?php echo $product['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
		</td>
	</tr>
	<?php } ?>
</table>