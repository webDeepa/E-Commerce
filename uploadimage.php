<?php include "include/header.php";?>
<article class="maincontent"><br>
<h1>Upload image</h1><br>
<section class="cont-bg frm-padding">
<form action="" method="post" enctype="multipart/form-data">
	<label class="label"> Upload Image </label> <input type="file" name="fileup" /><br><br>
	<div class="redtext"><?php echo $imageuploaderror;?></div>
	<button type="submit" class="btn" name="upload">Upload</button>
</form>
</section>
</article>
<?php include "include/footer.php";