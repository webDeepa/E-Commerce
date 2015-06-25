<?php include "include/header.php";?>
<article class="maincontent"><br><br>

	<h1>Payment</h1><br>
	<section class="cont-bg">
	<form action="" method="post" class="frm-padding">	
		<label class="biglabel" for="paymentmethod">Select a payment method</label>
		<select name="paymentmethod" class="dropdown" id="paymentmethod">
			<option value="visa" id="visa">VISA</option>
			<option value="mastercard" id="mastercard">MasterCard</option>
			<option value="paypal" id="paypal">PayPal</option>
		</select><br><br><br>
		<label class="biglabel" for="paymentmethod">Amount</label>
		<?php echo '$'. $_SESSION['total']; ?>
		<br>
		<button type="submit" name="pay" class="btn">Pay</button>
	</form>
	</section>
</article>
<?php include "include/footer.php";