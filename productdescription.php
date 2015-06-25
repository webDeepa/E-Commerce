<?php include "include/header.php";
include_once 'include/dbconnection.php';?>
<article class="maincontent">
<h1 class="pro-des-hd"><?php echo $productname;?></h1><br>
<?php 
	//fetching product description data for the corresponding productid from the db
	try
	{
		$sql = 'SELECT products.description,small,medium,large,extralarge FROM products
		inner join size
		on size.sizeid=products.sizeid
		where products.productid=:productid';
		$s = $pdo->prepare($sql);
		$s->bindValue(':productid', $productid);
		$s->execute();
	}
	catch (PDOException $e)
	{
		$error = 'Error fetching product description data from database: ' . $e->getMessage();
		include 'error.php';
		exit();
	}
	foreach ($s as $row)
	{
		$productdescriptionarray[] = array(
		'description' => $row['description'],
		'small' => $row['small'],
		'medium' => $row['medium'],
		'large' => $row['large'],
		'extralarge' => $row['extralarge']
		);
	}
	foreach ($productdescriptionarray as $description):?>
	<form action="" method="post" id="productdescriptionform">

		<section class="productdescription">
			<img src="<?php echo 'img/'.$productimageurl ;?>" alt="<?php echo $productname;?>">
			<section>
				
				<p><?php echo $description['description'];?></p>
				<p>Price<b><?php echo " $".$productprice;?></b></p>
			</section>	
			<div class="clearfix"></div>			
		</section>
		<div class="hr"></div>
		<?php 
			if ($description['small']==0 && $description['medium']==0 && $description['large']==0 && $description['extralarge']==0) 
			{
				echo '<span class="redtext">Sorry! Out of stock</span>';
			}
			else
			{
				?>
				<section id="sz-qu-sec">
					<section class="sizesection">
					<select name="size" class="dropdown" id="size">
						<?php
							echo '<option value="select" id="small">Select a size</option>';
							if ($description['small']>0) 
							{
								echo '<option value="small" id="small">Small</option>';
							}
							if ($description['medium']>0) 
							{
								echo '<option value="medium" id="medium">Medium</option>';
							}
							if ($description['large']>0) 
							{
								echo '<option value="large" id="large">Large</option>';
							}
							if ($description['extralarge']>0) 
							{
								echo '<option value="extralarge" id="extralarge">Extralarge</option>';
							}
							$quantityinstock=$description['small']+$description['medium']+$description['large']+$description['extralarge'];
							$quantityinsmall=$description['small'];
							$quantityinmedium=$description['medium'];
							$quantityinlarge=$description['large'];
							$quantityinextralarge=$description['extralarge'];
						?>
					</select>
					</section>				
				<section id="quantitysection">
					<label for="quantity">Quantity</label>
					<input name="quantity" type="number" required class="inputfield" id="quantity" min="1" max="99" value="<?php echo $quantity; ?>">
				</section>
				
				
				<input type="hidden" name="maincategoryid" value="<?php echo $maincategoryid;?>">
				<input type="hidden" name="subcategoryid" value="<?php echo $subcategoryid;?>">
				<input type="hidden" name="productid" value="<?php echo $productid;?>">
				<input type="hidden" name="productname" value="<?php echo $productname;?>">
				<input type="hidden" name="productimageurl" value="<?php echo $productimageurl;?>">
				<input type="hidden" name="productprice" value="<?php echo $productprice;?>">
				<input type="hidden" name="productdescription" value="<?php echo $description['description'];?>">
				<input type="hidden" name="quantityinstock" value="<?php echo $quantityinstock;?>">
				<input type="hidden" name="quantityinsmall" value="<?php echo $quantityinsmall;?>">
				<input type="hidden" name="quantityinmedium" value="<?php echo $quantityinmedium;?>">
				<input type="hidden" name="quantityinlarge" value="<?php echo $quantityinlarge;?>">
				<input type="hidden" name="quantityinextralarge" value="<?php echo $quantityinextralarge;?>">

				<button type="submit" class="btn pro-des-add-to-cart-btn" id="addtoshoppingcart" name="addtocart">Add to shopping cart</button>
				<button type="submit" class="addtowishlist" id="addtowishlist" name="addtowishlist">Add to wish list</button>
				<div class="clearfix"></div>
				</section>
				<section class="redtext pro-des-err" id="pro-des-error"></section>
				<section class="redtext pro-des-err"><?php echo $sizeerror; ?></section>
				<section class="redtext pro-des-err"><?php echo $quantityerror; ?></section><?php
			}
		?>
	</form>
	<?php endforeach;?>
</article>
<?php include "include/footer.php";