<?php include "include/header.php";?>
<article class="maincontent"><br>
<h1><?php echo $_SESSION['heading'];?></h1><br>
<section class="cont-bg">
	<form action="" method="post" class="ad-ctg-form frm-padding">
		<label class="label" ><?php echo $_SESSION['namefield'] ;?></label>
		<input type="text" required class="inputfield" id="ctg-name" name="name" value="<?php
		if (isset($_SESSION['editmaincategory'])|| isset($_SESSION['addmaincategory'])) {
			echo $_SESSION['maincategoryname'];
		}
		if (isset($_SESSION['editsubcategory'])|| isset($_SESSION['addsubcategory'])) {
			echo $_SESSION['subcategoryname'];
		}
		 ?>">
		<br>
		<br>
		<label class="label" >Description</label>
		<textarea type="text" class="inputfield multiline" maxlength="200" id="description" name="description">
		<?php echo $_SESSION['description'];?></textarea><br><br><br>
			
		<?php if(isset($_SESSION['editmaincategory']) || isset($_SESSION['editsubcategory'])):
		
			if(isset($_SESSION['editmaincategory'])):?>
				<img src="<?php echo 'img/'.$_SESSION['maincategoryimageurl'];?>"  alt="<?php echo $_SESSION['maincategoryname'];?> Clothing" >
				<br><br>
			<?php endif;
			if(isset($_SESSION['editsubcategory'])):?>
				<img src="<?php echo 'img/'.$_SESSION['subcategoryimageurl'];?>"  alt="<?php echo $_SESSION['subcategoryname'];?> Clothing" >
				<br><br>
			<?php endif;?>
			<input type="radio" name="editimage" id="oldimage" value="oldimage"><label for="oldimage">Use the same image</label>
			<br><br>
			<input type="radio" name="editimage" id="uploadimage" value="uploadimage"><label for="uploadimage"> Upload new image</label><br>
			<button type="submit" class="btn" id="ad-editbtn" name="<?php if(isset($_SESSION['editmaincategory'])){echo 'editmaincategorysubmit';}else{echo 'editsubcategorysubmit';}?>">Submit</button>
		<?php endif;?>
		
		<div class="redtext" id="ad-ctg-error"><?php echo $admincategoryerror;?></div>
		<?php
			if (isset($_SESSION['addmaincategory']) || isset($_SESSION['addsubcategory'])) :?>
				<button type="submit" class="btn" id="ad-addbtn" name="<?php if(isset($_SESSION['addmaincategory'])){echo 'addmaincategorysubmit';}else{echo 'addsubcategorysubmit';}?>">Proceed to upload image</button>
			<?php endif;?>
	</form>
	</section>
</article>
<?php include "include/footer.php";