<?php include "include/header.php";?>
<article class="maincontent"><br>
	<h1>Change password</h1><br>
	<section class="cont-bg">
	<form action="" method="post" class="frm-padding">
		<label class="label" for="oldpassword">Old password</label>
		<input type="password" required name="oldpassword" id="oldpassword" class="inputfield" maxlength="50" >
		<br>
		<br>
		<label class="label" for="newpassword">New password</label>
		<input type="password" required name="newpassword" id="newpassword" class="inputfield" maxlength="50" >
		<br><br>
		<div id="passwordError" class="redtext"><?php echo "$passwordError";?></div>
		
		<button type="submit" class="btn" name="changepasswordsubmit">Submit</button>
	</form>
	</section>
</article>
<?php include "include/footer.php";
