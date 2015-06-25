<?php 
if ($display==TRUE) :
	include "include/header.php";?>
	<article class="maincontent"><br>
	<h1>My wish list</h1><br>
<?php	
endif;
	$itemalreadyexists=FALSE;
	if (isset($_SESSION['productid'])) 
	{ 
		$currentproductid=$_SESSION['productid'];
	}
	//fetching the product id in the wishlist table
	try
	{
		$sql = 'SELECT * FROM wishlist WHERE customerid=:customerid';
		$s = $pdo->prepare($sql);
		$s->bindValue(':customerid', $_SESSION['customerid']);
		$s->execute();
	}
	catch (PDOException $e)
	{
		$error = 'Error fetching product and customer data from the database: ' . $e->getMessage();
		include 'error.php';
		exit();
	}
	foreach ($s as $row)
	{
		$wishlistitems[] = array(
		'productid' => $row['productid']		
		);
	}
	if (isset($_SESSION['productid'])) 
	{ 
		if (isset($wishlistitems))
		{
			//Checking if the current product already exits in the wishlist
			foreach ($wishlistitems as $item)
			{
				if ($item['productid']==$currentproductid) {
					
					$itemalreadyexists=TRUE;
				}
			}
		}
		//if the product does not exist in the wishlist then inserts it in the wishlist
		if ($itemalreadyexists==FALSE)		
		{
			//inserting the product into the wishlist table of the corresponding customer.
			try
			{
				$sql = 'INSERT INTO wishlist SET customerid=:customerid,productid=:productid';
				$s = $pdo->prepare($sql);
				$s->bindValue(':customerid', $_SESSION['customerid']);
				$s->bindValue(':productid', $currentproductid);
				$s->execute();
			}
			catch (PDOException $e)
			{
				$error = 'Error inserting product and customer data into the database: ' . $e->getMessage();
				include 'error.php';
				exit();
			}
			unset($wishlistitems);
			//fetching the updated version of the wishlist table
			try
			{
				$sql = 'SELECT * FROM wishlist WHERE customerid=:customerid';
				$s = $pdo->prepare($sql);
				$s->bindValue(':customerid', $_SESSION['customerid']);
				$s->execute();
			}
			catch (PDOException $e)
			{
				$error = 'Error fetching product and customer data from the database: ' . $e->getMessage();
				include 'error.php';
				exit();
			}
			foreach ($s as $row)
			{
				$wishlistitems[] = array(
				'productid' => $row['productid']		
				);
			}

		}
	}
	if ($display==TRUE) 
	{?> <section class="cont-bg wishlistform">
<?php
		//display the items in the wishlist table
		if (isset($wishlistitems) and count($wishlistitems)>0) 
		{		
			foreach ($wishlistitems as $item):
				//fetching product information for every product in the wish list.
				try
				{
					$sql2 = 'SELECT * FROM products WHERE productid=:productid';
					$s2 = $pdo->prepare($sql2);
					$s2->bindValue(':productid', $item['productid']);
					$s2->execute();
				}
				catch (PDOException $e)
				{
					$error = 'Error fetching product information(for the wishlist) from the database: ' . $e->getMessage();
					include 'error.php';
					exit();
				}
				
				foreach ($s2 as $row)
				{
					
					$productname = $row['productname'];
					$productprice= $row['price'];
					$productimageurl = $row['productimageurl']	;	
					
				}

				echo '<h2>'.$productname.'</h2>';?>
				<form action="" method="post">
					<button type="submit" id="wishlistform-btn-img" class="linklook" name="product">
						<img src="<?php echo 'img/'.$productimageurl ;?>" alt="<?php echo $productname;?>">
					</button>
					<p>Price<b><?php echo " $".$productprice;?></b></p>
					<input type="hidden" name="productid" value="<?php echo $item['productid'];?>">
					<input type="hidden" name="productname" value="<?php echo $productname;?>">
					<input type="hidden" name="productprice" value="<?php echo $productprice;?>">
					<input type="hidden" name="productimageurl" value="<?php echo $productimageurl;?>">
					<button type="submit" class="addtocart" name="product">Add to cart</button>
					<button type="submit" class="removefromwishlist" name="removefromwishlist">Remove from wish list</button>
				</form>
				<div class="clearfix"></div>
				<hr>
				<?php
			endforeach;
			if (isset($_SESSION['productid'])) {
				unset($_SESSION['productid']);
			}					
		}
		else
		{
			echo 'Your wishlist is empty.';
		}?>
		</section>
		</article>
		<?php include "include/footer.php";
	}

	
