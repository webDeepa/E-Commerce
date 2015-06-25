<?php include "include/header.php";?>
<article class="maincontent">
<br>
<h1>Log In</h1><br>
<section class="cont-bg">
	<form action="" method="post" class="frm-padding">
	
		<label class="label" for="email">Email</label>
		<input type="email" required name="email" id="email" class="inputfield" maxlength="50" value="<?php echo $useremail?>">
		<br>
		<div id="emailError" class="redtext"><?php echo "$emailError";?></div>
		<br>
		<label class="label" for="password">Password</label>
		<input type="password" required name="password" class="inputfield" id="password"><br>
		<div id="passwordError" class="redtext"><?php echo "$passwordError";?></div>
		<br>
		
		<button type="submit" class="btn" name="login" id="btnloginsubmit">Submit</button>
		<br><br>
		<button type="submit" name="signupform" class="linklook" >New to TREND ! Sign up now</button><br><br>
		<div id="loginerror" class="redtext"><?php echo $loginerror?></div>
		
	</form>
</section>
</article>
<?php include 'include/footer.php';?>