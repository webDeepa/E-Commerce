<?php include "include/header.php";?>
<article class="maincontent">
<section><?php echo $logoutinfo; ?></section>
<section  id='acknowledgement'><?php echo $acknowledgement; ?></section>
<p class="hom-hd">Explore a collection of latest Mens Fashion Clothing </p>
<br><section class="cont-bg frm-padding">
<?php 
//fetching maincategory data from db
try
{
	$sql = 'SELECT * FROM maincategory';
	$result = $pdo->query($sql);
}
catch (PDOException $e)
{
	$error = 'Error fetching maincategory data from database: ' . $e->getMessage();
	include 'error.php';
	exit();
}
foreach ($result as $row)
{
	$maincategories[] = array(
	'maincategoryid' => $row['maincategoryid'],
	'maincategoryname' => $row['maincategoryname'],
	'maincategoryimageurl' => $row['maincategoryimageurl'],
	'description' =>$row['description']
	
	);
}?> 
<?php foreach ($maincategories as $maincategory):?>
	<form action="" method="post" class="maincategoryform" >
		<button type="submit" name="maincategory" class="categorybtn">
			<figure  class="CategoryImg style">
				<img src="<?php echo 'img/'.$maincategory['maincategoryimageurl'] ;?>"  alt="<?php echo $maincategory['maincategoryname'];?> Clothing" >
				<figcaption class="categoryName">
					<?php echo $maincategory['maincategoryname'];?>
				</figcaption>
				<input type="hidden" name="maincategoryid" value="<?php echo $maincategory['maincategoryid'] ;?>">
				<input type="hidden" name="maincategoryname" value="<?php echo $maincategory['maincategoryname'] ;?>">
				
				<input type="hidden" name="maincategoryimageurl" value="<?php echo $maincategory['maincategoryimageurl'] ;?>">
				<input type="hidden" name="description" value="<?php echo $maincategory['description'] ;?>">
			</figure>
		</button>
		<?php
			if (isset($_SESSION['admin'])) {
				echo '<button type="submit" class="btn editmaincategorybtn" name="editmaincategory">Edit</button>';
			}
		?>		
	</form>
<?php endforeach;
if (isset($_SESSION['admin'])) {?>
	<form action="" method="post">
		<button type="submit" class="btn addmaincategorybtn" name="addmaincategory">Add category</button>
	</form>
<?php } ?>
<div class="clearfix"></div>
</section>
</article>
<?php include "include/footer.php";