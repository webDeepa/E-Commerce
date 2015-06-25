<?php include "include/header.php";?>
<article class="maincontent">
<p><b>Your payment was successful</b></p>
	<br><h1>Invoice</h1><br>
	<section class="cont-bg frm-padding">
	<?php
		try
		{
			$sql = 'SELECT * FROM orders
			inner join orderdetails
			on orderdetails.ordernumber=orders.ordernumber
			where orders.ordernumber=:ordernumber';
			$s = $pdo->prepare($sql);
			$s->bindValue(':ordernumber', $_SESSION['lastordernumber']);
			$s->execute();
		}
		catch (PDOException $e)
		{
			$error = 'Error fetching invoice data from database: ' . $e->getMessage();
			include 'error.php';
			exit();
		}
		foreach ($s as $row)
		{
			$invoice[] = array(
			'productid' => $row['productid'],
			'productname' => $row['productname'],
			'productdescription' => $row['productdescription'],
			'size'=>$row['size'],
			'price' => $row['price'],
			'quantity'=>$row['quantity'],
			'subtotal'=>$row['subtotal']			
			);
			$ordernumber=$row['ordernumber'];
			$orderdate=$row['orderdate'];
			$shippingname=$row['shippingname'];
			$shippingaddress=$row['shippingaddress'];
			$billingaddress=$row['billingaddress'];
			$deliverytype=$row['deliverytype'];
			$phonenumber=$row['phonenumber'];
		}
	?>
	<h5 class="ordernumber"><label class="label">Order number</label>:<label class="label"><?php echo $ordernumber ;?></label></h5>
	<h5 class="ordernumber"><label class="label">Order date</label>:<label class="label"><?php echo $orderdate;?></label></h5>
	<h4>Billing details</h4>
	<h5><?php echo $_SESSION['name'];?></h5>
	<p><?php echo $billingaddress;?></p>
	<h4>Shipping details</h4>
	<h5><?php echo $shippingname ;?></h5>
	<p><?php echo $shippingaddress ;?></p>
	<p>Delivery type:<?php echo $deliverytype;?></p>
	<p>Phone number:<?php echo $phonenumber;?></p>
	
	<?php

	foreach($invoice as $item)
	{
		?>
		<section class="cartitemdisplay">
			<?php echo '<label class="label">Product name</label>:<b>'.$item['productname'].'</b><br><br><label class="label">Unit price</label>: '.$item['price'];?>
		</section>
		<section class="cartitemdisplay">
			<?php echo '<label class="label">Size</label>: '.$item['size'].'<br><br><label class="label">Quantity</label>: '. $item['quantity'].'<br><br>
			<label class="label">Subtotal</label>: '.'$'. $item['subtotal'];?>
		</section>
		<div id="separator"> <hr></div>
		<?php
	}
	$total=0;
	foreach($invoice as $item)
	{
		$total+=$item['subtotal'];
	}
	?>

	<section id="totalsection">
		<?php echo '<label class="label">Total</label>: '.'$'.$total;?>
	</section>
	<p class="billstatus"><label class="label">Bill status</label>: Paid</p>
	</section>
</article>
<?php 
include "include/footer.php";