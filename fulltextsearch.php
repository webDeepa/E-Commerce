<?php
 include "include/header.php";?>
<article class="maincontent"><br>
<h1>Search result</h1><br>
<section class="cont-bg frm-padding">
<?php
$searchstring = removeUnwanted($_POST['searchtext']);
$searchstring = $searchstring."*";
try
{
	$sql = "SELECT * FROM products
	where MATCH(description,productkeywords) AGAINST(:searchstring IN BOOLEAN MODE)";
	$s = $pdo->prepare($sql);
	$s->bindValue(':searchstring', $searchstring);
	$s->execute();
}
catch(PDOException $e)
{
	$error = 'Error serching data in db that match search string: ' . $e->getMessage();
    include 'error.php';
    exit();
}

if (!empty($s)) {
	foreach ($s as $row)
	{
		$products[] = array(
			'productid' => $row['productid'],
			'productname' => $row['productname'],
			'productimageurl' => $row['productimageurl'],
			'price' => $row['price'],
			'description'=>$row['description']
		);
		
	}
	if (isset($products)) {
		foreach ($products as $product):
		?>
			<form action="" method="post">
				
				<input type="hidden" name="productid" value="<?php echo $product['productid'] ;?>">
				<input type="hidden" name="productname" value="<?php echo $product['productname'] ;?>">
				<input type="hidden" name="productimageurl" value="<?php echo $product['productimageurl'] ;?>">
				<input type="hidden" name="productprice" value="<?php echo $product['price'] ;?>">
				<input type="hidden" name="description" value="<?php echo $product['description'] ;?>">				
				<input type="submit" name="product" class="linklook search_res_link" value="<?php echo $product['productname'];?>">
				<p id="searchdescription"><?php echo $product['description'] ;?></p>
				<br>
			</form>
		<?php
		endforeach;
	}
	else
	{
		echo "Sorry, no match found. Please try typing a different keyword.";
	}
	
}

?>
</section>
</article>
<?php include "include/footer.php";