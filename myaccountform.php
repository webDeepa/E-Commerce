<?php include "include/header.php";?>
<article class="maincontent"><br>
	<h1>Account details</h1>
	<br>
	<section class="cont-bg">
	<form action="" method="post" class="frm-padding">	
		<label class="label" for="fname">First name</label>
		<input type="text" required name="fname" id="fname" class="inputfield" maxlength="50" value="<?php echo $firstname;?>">
		<br>
		<br>
		<label class="label" for="lname">Last name</label>
		<input type="text" required name="lname" id="lname" class="inputfield" maxlength="50" value="<?php echo $lastname;?>">
		<br>
		<div id="nameerror" class="redtext"><?php echo "$nameerror";?></div>
		<br>
		<label class="label" for="phone">Phone</label>
		<input type="tel" name="phone" id="phone" class="inputfield" maxlength="50" value="<?php echo $phone;?>">
		<br>
		<div id="phoneerror" class="redtext"><?php echo "$phoneerror";?></div>
		<br>
		<br>
		<label class="label" for="address">Address</label>
		<textarea type="text" id="address" class="inputfield multiline" maxlength="200" name="address"><?php echo $address;?></textarea><br> 
		<div id="addresserror" class="redtext"><?php echo "$addresserror";?></div>
		<br>
		<button type="submit" class="btn" name="updateaccount">Submit</button>
		<br>
		<div id="error" class="redtext"><?php echo $myaccountediterror?></div>		
	</form>
	</section>
</article>
<?php include "include/footer.php";

