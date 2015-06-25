<?php include "include/header.php";?>
<article class="maincontent"><br>
	<h1>Shipping details</h1><br>
	<section class="cont-bg">
	<form action="" method="post" class="frm-padding">	
		<label class="label" for="deliverytype">Delivery type</label>
		<select name="deliverytype" class="dropdown" id="deliverytype">
			<option value="standard" id="standard">Standard</option>
			<option value="fast" id="fast">Fast</option>
			<option value="express" id="express">Express</option>
		</select>
		<br>
		<br>
		<label class="label" for="shippingname">Name</label>
		<input type="text" required class="inputfield" name="shippingname" id="shippingname" value="<?php echo $_SESSION['name'];?>">
		<br>
		<br>
		<label class="label" for="phone">Phone</label>
		<input type="tel" required name="shippingphone" id="phone" class="inputfield" maxlength="50" value="<?php echo $_SESSION['phone'] ;?>">
		<br>
		<br>		
		<label class="label" for="shippingaddress">Shipping address</label>
		<textarea type="text" required class="inputfield multiline" name="shippingaddress" id="shippingaddress"></textarea>
		<br>
		<br>
		<label class="label" for="billingaddress">Billing address</label>
		<textarea type="text" required class="inputfield multiline"  name="billingaddress" id="billingaddress"><?php echo $_SESSION['address'];?></textarea>
		<br>
		<br>
		
		<div id="shippingerror" class="redtext"><?php echo $shippingerror;?></div>
		<button type="submit" class="btn" name="shippingsubmit">Continue</button>
	</form>
	</section>
</article>
<?php include "include/footer.php";