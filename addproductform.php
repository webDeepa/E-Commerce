<?php include "include/header.php";?>
<article class="maincontent"><br>
<h1>Add product</h1><br>
<section class="cont-bg">
	<form action="" method="post" class="ad-pdt-form frm-padding">
		<label class="label" >Product name</label>
		<input type="text" required class="inputfield" id="productname" name="productname" value="<?php echo $_SESSION['productname'];?>">
		<br>
		<br>
		<label class="label" >Description</label>
		<textarea type="text" id="pro-description" required class="inputfield multiline" maxlength="200" name="description">
		<?php echo $_SESSION['description'];?></textarea><br><br>
		<label class="label" >Price</label>
		<input type="number" required class="inputfield"  min="1" max="200" step="any" id="productprice" name="productprice" value="<?php echo $_SESSION['productprice'];?>">
		<br>
		<br>
		<label class="label" >Available sizes</label>
		<br>
		<br>
		<label class="label" >Small</label>
		<input type="number" required id="small" class="inputfield"  min="0" max="100"  name="small" value="<?php echo $_SESSION['small'];?>">
		<br>
		<br>
		<label class="label" >Medium</label>
		<input type="number" required id="medium" class="inputfield"  min="0" max="100" name="medium" value="<?php echo $_SESSION['medium'];?>">
		<br>
		<br>
		<label class="label" >Large</label>
		<input type="number" required id="large" class="inputfield"  min="0" max="100"  name="large" value="<?php echo $_SESSION['large'];?>">
		<br>
		<br>
		<label class="label" >Extralarge</label>
		<input type="number" required class="inputfield" id="extralarge" min="0" max="100" name="extralarge" value="<?php echo $_SESSION['extralarge'];?>">
		<br>
		<br>
		<label class="label" >Product Keywords</label>
		<textarea type="text" id="ad-pro-keywords" required class="inputfield multiline" maxlength="200" name="pro-keywords">
		<?php echo $_SESSION['pro-keywords'];?></textarea>		
		<br>
		<br>
		<div class="redtext" id="addproducterror"><?php echo $addproducterror;?></div>		
		<button type="submit" id="addproductsubmit" class="btn" name="addproductsubmit">Submit</button>
	</form>
	</section >
</article>
<?php include "include/footer.php";