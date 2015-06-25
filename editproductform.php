<?php include "include/header.php";?>
<article class="maincontent"><br>
<h1>Edit product</h1><br>
<section class="cont-bg">
	<form action="" method="post" class="ed-pdt-form frm-padding" >
		<label class="label" >Product name</label>
		<input type="text" required class="inputfield" id="productname" name="productname" value="<?php echo $_SESSION['productname'];?>">
		<br>
		<br>
		<label class="label" >Description</label>
		<textarea type="text" required class="inputfield multiline" maxlength="200" id="pro-description" name="productdescription">
		<?php echo $_SESSION['description'];?></textarea><br><br>
		<label class="label" >Product Keywords</label>
		<textarea type="text" required id="ed-pro-keywords" class="inputfield multiline" maxlength="200" name="pro-keywords">
		<?php echo $_SESSION['pro-keywords'];?></textarea>		
		<br>
		<br>
		<label class="label" >Price</label>
		<input type="number" required class="inputfield" id="productprice" min="1" max="200" step="any" name="productprice" value="<?php echo $_SESSION['productprice'];?>">
		<br>
		<br>
		<img src="<?php echo 'img/'.$_SESSION['productimageurl'];?>"  alt="<?php echo $_SESSION['productname'];?> Clothing" >
		<br><br>
		<input type="radio"  name="editimage" id="oldimage" value="oldimage"><label for="oldimage">Use the same image</label>
		<br><br>
		<input type="radio" name="editimage" id="uploadimage" value="uploadimage"><label for="uploadimage"> Upload new image</label><br><br>
		<div class="redtext" id="editproducterror"><?php echo $editproducterror;?></div>		
		<button type="submit" class="btn" id="editproductsubmit" name="editproductsubmit">Submit</button>
	</form>
	</section>
</article>
<?php include "include/footer.php";