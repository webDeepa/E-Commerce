<?php include "include/header.php";?>
<article class="maincontent"><br>
	<h1>Contact</h1><br>
	<section class="cont-bg">
	<article class="contact">
		<section class="contactsection">
			<h3>Verbally</h3>
			<p>114 alexander st, </p>
			<p>Hamilton central, Hamilton </p>
			<p>3204.</p>
			<p><b>Email</b> info@trend.co.nz</p>
			<p><b>Phone</b> 0800 555 666</p>
		</section>
		<section class="contactsection">
			<h3>Virtually</h3>
			<form action="" method="post" id="contactform">
				<input type="text" required id="name" name="name" placeholder="Name" class="inputfield" value="<?php echo $name;?>"><br><br>
				<div id="nameerror" class="redtext"><?php echo "$nameerror";?></div><br>
				<input type="text" required name="email" placeholder="Email" id="email" class="inputfield" value="<?php echo $email;?>"><br><br>
				<div id="emailerror" class="redtext"><?php echo "$emailerror";?></div><br>
				<input type="tel" required name="phone" placeholder="Phone" id="phone" class="inputfield" value="<?php echo $phone;?>"><br><br>
				<div id="phoneerror" class="redtext"><?php echo "$phoneerror";?></div><br>
				<textarea type="text" required name="message" placeholder="Message" id="message" class="inputfield multiline" ><?php echo $message;?></textarea><br><br>
				<div id="messageerror" class="redtext"><?php echo "$messageerror";?></div>
				<button type="submit" name="send" id="sendbtn" class="btn sendbtn">Send</button><br><br>
				<div id="contactformerror" class="redtext"><?php echo "$contactformerror";?></div>
			</form>
		</section>
	</article>
	<div class="clearfix"></div>
	</section>
</article>
<?php include "include/footer.php";