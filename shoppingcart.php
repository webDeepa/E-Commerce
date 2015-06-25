<?php include "include/header.php";?>
<article class="maincontent"><br>
<h1>My shopping Cart</h1><br>
<section class="cont-bg cart-cont">
<?php
	if (!isset($_SESSION['items'])) 
	{
  		$_SESSION['items'] = array();
	}
	if (count($_SESSION['items'])==0 and !isset($_SESSION['productid']))
	{
		echo 'Your cart is empty.';
	}
	if (isset($_SESSION['productid'])) 
	{ 		
		$productid=$_SESSION['productid'];
		$productname=$_SESSION['productname'];
		$productimageurl=$_SESSION['productimageurl'];
		$productprice=$_SESSION['productprice'];
		$productdescription=$_SESSION['productdescription'];
		$size=$_SESSION['size'];
		$quantity=$_SESSION['quantity'];
		$subtotal= $quantity * $productprice;
		//inserting items into the session array
		$itemid=$productid;
		$_SESSION['items'][$itemid] = array('productid'=>$productid,'productname' => $productname,'productdescription' => $productdescription,'productimageurl' => $productimageurl ,'unitprice' => $productprice,
			'size' => $size,'quantity' => $quantity, 'subtotal' => $subtotal);
	}
	if (count($_SESSION['items'])>0) 
	{
		//displaying items in the cart
		foreach($_SESSION['items'] as $item)
		{
			?>
			<section class="cartitemdisplay">
				<form action="" method="post">
					<input type="hidden" name="productid" value="<?php echo $item['productid'];?>">
					<input type="hidden" name="productname" value="<?php echo $item['productname'];?>">
					<input type="hidden" name="productimageurl" value="<?php echo $item['productimageurl'];?>">
					<input type="hidden" name="productprice" value="<?php echo $item['unitprice'];?>">
					<input type="hidden" name="productdescription" value="<?php echo $item['productdescription'];?>">
					<button type="submit" id="cartitemdisplay-btn-img" class="linklook" name="product">
						<img src="<?php echo 'img/'.$item['productimageurl'];?>" alt="<?php echo $item['productname'];?>">
					</button>
				</form>
			</section>
			<section class="cartitemdisplay">
				<?php echo '<b>'.$item['productname'].'</b><br><br><label class="label">Unit price</label>: '.$item['unitprice'];?>
			</section>
			<section class="cartitemdisplay">
				<?php echo '<label class="label">Size</label>: '.$item['size'].'<br><br><label class="label">Quantity</label>: '. $item['quantity'].'<br><br>
				<label class="label">Subtotal</label>: '.'$'. $item['subtotal'];?>
			</section>
			<section class="optionbtn">
			<form action="" method="post">
				<input type="hidden" name="productid" value="<?php echo $item['productid'];?>">
				<button type="submit" class=" movetowishlist" name="movetowishlist">Move to wish list</button>
				<button type="submit" class=" removefromcart" name="removefromcart">Remove from shopping cart</button>
			</form>
			</section>
			<div id="separator"> <hr></div>
			<?php
		}
		$total=0;
		foreach($_SESSION['items'] as $item)
		{
			$total+=$item['subtotal'];
		}
		$_SESSION['total']=$total;
		?>

		<section id="totalsection">
			<?php echo '<label class="label">Total</label>: '.'$'.$total;?>
			<form action="" method="post">
				<button type="submit" class="btn" name="proceedtocheckout" id="proceedtocheckout">Proceed to checkout</button>
			</form>
		</section>
		<div class="clearfix"></div>	
	<?php } ?>
	</section>
</article>
<?php include "include/footer.php";