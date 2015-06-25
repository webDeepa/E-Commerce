<?php include "include/header.php";?>
<article class="maincontent">
<br>
<h1>Sign Up</h1><br>
<section class="cont-bg">
	<form action="" method="post" class="frm-padding">
	
		<label class="label" for="fname">First name</label>
		<input type="text" required name="fname" id="fname" class="inputfield" maxlength="50" value="<?php echo $firstname?>">
		<br>
		<br>
		<label class="label" for="lname">Last name</label>
		<input type="text" required name="lname" id="lname" class="inputfield" maxlength="50" value="<?php echo $lastname?>">
		<br><div id="nameError" class="redtext"><?php echo "$nameError";?></div><br>
		<label class="label" for="email">Email</label>
		<input type="email" required name="email" id="email" class="inputfield" maxlength="50" value="<?php echo $useremail?>">
		<br>
		<div id="emailError" class="redtext"><?php echo "$emailError";?></div>
		<br>
		<label class="label" for="password">Password</label>
		<input type="password" required name="password" class="inputfield" id="password"><br>
		<div id="passwordError" class="redtext"><?php echo "$passwordError";?></div>
		<br>
		
		<button type="submit" class="btn" name="signup" id="btnsignupsubmit">Submit</button>
		<br>

		<div id="signuperror" class="redtext"><?php echo $signuperror?></div>
		
	</form>
	</section>
</article>
<?php include 'include/footer.php';?>