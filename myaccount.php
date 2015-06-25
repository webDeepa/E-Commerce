<?php include "include/header.php";?>
<article class="maincontent"><br>
	<h1>Account details</h1><br>
<?php

	try
	{
		$sql = 'SELECT firstname,lastname,email,phone,address FROM customers
		where customers.customerid=:customerid';
		$s = $pdo->prepare($sql);
		$s->bindValue(':customerid', $_SESSION['customerid']);
		$s->execute();
	}
	catch (PDOException $e)
	{
		$error = 'Error fetching customer data from database: ' . $e->getMessage();
		include 'error.php';
		exit();
	}
	foreach ($s as $row)
	{		
		$firstname = $row['firstname'];
		$lastname = $row['lastname'];
		$email = $row['email'];
		$phone= $row['phone'];
		$address=$row['address'];
	}	
?><section class="cont-bg">
	<form action="" method="post" class="frm-padding">
	
		<label class="label" >First name</label>
		<?php echo $firstname;?>
		<br>
		<br>
		<label class="label">Last name</label>
		<?php echo $lastname;?>
		<br>
		<br>
		<label class="label">Email</label>
		<?php echo $email;?>
		<br><br><label class="label">Phone</label>
		<?php if(!empty($phone)){ echo $phone;}else{echo "Not available";}?>
		<br><br><label class="label">Address</label>
		<?php if(!empty($address)){ echo $address;}else{echo "Not available";}?>
		<br>
		<br>
		<input type="hidden" name="firstname" value="<?php echo $firstname;?>" >
		<input type="hidden" name="lastname" value="<?php echo $lastname;?>" >
		<input type="hidden" name="phone" value="<?php echo $phone;?>" >
		<input type="hidden" name="address" value="<?php echo $address;?>" >
		<button type="submit"class="linklook" id="changepassword" name="changepassword" >Change password</button><br>
		<button type="submit" class="btn" name="editinformation">Edit</button>
		<br>
	</form>
	</section>
</article>
<?php include "include/footer.php";