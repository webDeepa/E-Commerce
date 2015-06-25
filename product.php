<?php include "include/header.php";?>
<article class="maincontent">
<section  id='acknowledgement'><?php echo $productacknowledgement; ?></section>
<h1 class="pro-head"><?php echo $subcategoryname;?></h1><br>
<?php 
//fetching product data for the corresponding subcategoryid from the db
	try
	{
		$sql = 'SELECT productid,productname,productimageurl,productkeywords,products.description,price,subcategory.subcategoryname FROM products
		inner join subcategory
		on subcategory.subcategoryid=products.subcategoryid
		inner join maincategory
		on maincategory.maincategoryid=subcategory.maincategoryid
		where subcategory.subcategoryid=:subcategoryid';
		$s = $pdo->prepare($sql);
		$s->bindValue(':subcategoryid', $subcategoryid);
		$s->execute();
	}
	catch (PDOException $e)
	{
		$error = 'Error fetching product data from database: ' . $e->getMessage();
		include 'error.php';
		exit();
	}
	$products = array();
	if (!empty($s)) {
		foreach ($s as $row)
		{
			$products[] = array(
			'productid' => $row['productid'],
			'productname' => $row['productname'],
			'productimageurl' => $row['productimageurl'],
			'price' => $row['price'],
			'pro-keywords' => $row['productkeywords'],
			'description'=>$row['description']
			);
			$subcategoryname=$row['subcategoryname'];
		}
	}?> <section class="cont-bg frm-padding">
<?php
if (!empty($products)) {
	foreach ($products as $product):?>
		<form action="" method="post" class="maincategoryform" id="pro-form">
			<button type="submit" name="product" class="categorybtn">
				<figure  class="CategoryImg pro">
					<img src="<?php echo 'img/'.$product['productimageurl'] ;?>"  alt="<?php echo $product['productname'];?> Clothing" >
					<figcaption class="categoryName">
						<?php echo $product['productname'];?>
						<span class="price"><?php echo " $".$product['price'];?></span>
					</figcaption>
					<input type="hidden" name="maincategoryid" value="<?php echo $maincategoryid ;?>">
					<input type="hidden" name="subcategoryid" value="<?php echo $subcategoryid ;?>">
					<input type="hidden" name="subcategoryname" value="<?php echo $subcategoryname;?>">
					<input type="hidden" name="productid" value="<?php echo $product['productid'] ;?>">
					<input type="hidden" name="productname" value="<?php echo $product['productname'] ;?>">
					<input type="hidden" name="productimageurl" value="<?php echo $product['productimageurl'] ;?>">
					<input type="hidden" name="productprice" value="<?php echo $product['price'] ;?>">
					<input type="hidden" name="pro-keywords" value="<?php echo $product['pro-keywords'] ;?>">
					<input type="hidden" name="description" value="<?php echo $product['description'] ;?>">
				</figure>
			</button>
			<?php
				if (isset($_SESSION['admin'])) :?>
					<button type="submit" class="btn editproductbtn" name="editproduct">Edit</button>
					<button type="submit" class="btn deleteproductbtn" name="deleteproduct">Delete</button>
				<?php endif;
			?>	
		</form>
	<?php endforeach;
} 
else
{
	echo "Sorry, currently no products are available.<br><br>";	
}
if (isset($_SESSION['admin'])) :?>
	<form action="" method="post">
		<input type="hidden" name="subcategoryid" value="<?php echo $subcategoryid;?>">
		<input type="hidden" name="subcategoryname" value="<?php echo $subcategoryname;?>">
		<button type="submit" class="btn addproductbtn" name="addproduct">Add product</button>
	</form>
<?php endif;?>
<div class="clearfix"></div>
</section>
</article>
<?php include "include/footer.php";