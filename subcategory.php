<?php include "include/header.php";?>
<article class="maincontent">

<section  id='acknowledgement'><?php echo $subcategoryacknowledgement; ?></section>
<h1 class="sub-ctg-head"><?php echo $maincategoryname;?></h1><br><section class="cont-bg frm-padding">
<?php 
//fetching subcategory data for the corresponding maincategoryid from the db
	try
	{
		$sql = 'SELECT subcategoryid,subcategoryname,subcategoryimageurl,subcategory.maincategoryid,subcategory.description,maincategory.maincategoryname FROM subcategory
		inner join maincategory
		on maincategory.maincategoryid=subcategory.maincategoryid
		where maincategory.maincategoryid=:maincategoryid';
		$s = $pdo->prepare($sql);
		$s->bindValue(':maincategoryid', $maincategoryid);
		$s->execute();
	}
	catch (PDOException $e)
	{
		$error = 'Error fetching subcategory data from database: ' . $e->getMessage();
		include 'error.php';
		exit();
	}
	$subcategories = array();
	if (!empty($s)) {
		foreach ($s as $row)
		{
			$subcategories[] = array(
			'subcategoryid' => $row['subcategoryid'],
			'subcategoryname' => $row['subcategoryname'],
			'subcategoryimageurl' => $row['subcategoryimageurl'],
			'maincategoryid' => $row['maincategoryid'],
			'description'=>$row['description']			
			);
			$maincategoryname=$row['maincategoryname'];
		}			
	}?> 
<?php
if (!empty($subcategories)) {
	foreach ($subcategories as $subcategory):?>
		<form action="" method="post" class="maincategoryform" >
			<button type="submit" name="subcategory" class="categorybtn">
				<figure  class="CategoryImg style">
					<img src="<?php echo 'img/'.$subcategory['subcategoryimageurl'] ;?>"  alt="<?php echo $subcategory['subcategoryname'];?> Clothing" >
					<figcaption class="categoryName ">
						<?php echo $subcategory['subcategoryname'];?>
					</figcaption>
					<input type="hidden" name="maincategoryid" value="<?php echo $subcategory['maincategoryid'] ;?>">
					<input type="hidden" name="subcategoryid" value="<?php echo $subcategory['subcategoryid'] ;?>">
					<input type="hidden" name="subcategoryname" value="<?php echo $subcategory['subcategoryname'] ;?>">
					<input type="hidden" name="subcategoryimageurl" value="<?php echo $subcategory['subcategoryimageurl'] ;?>">
					<input type="hidden" name="subcategorydescription" value="<?php echo $subcategory['description'] ;?>">
					
					<input type="hidden" name="maincategoryname" value="<?php echo $maincategoryname ;?>">
				</figure>
			</button>
			<?php
				if (isset($_SESSION['admin'])) {
					echo '<button type="submit" class="btn editsubcategorybtn" name="editsubcategory">Edit</button>';
				}
			?>	
		</form>
	<?php endforeach;
}
else
{
	echo "Sorry, currently no subcategory is available.<br><br>";	
}
if (isset($_SESSION['admin'])) :?>
	<form action="" method="post">
	<input type="hidden" name="maincategoryid" value="<?php echo $maincategoryid;?>">
	<button type="submit" class="btn addsubcategorybtn" name="addsubcategory">Add subcategory</button>
	</form>
<?php endif;?>
<div class="clearfix"></div>
</section>
</article>
<?php include "include/footer.php";