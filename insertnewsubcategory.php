<?php 
//insert new subcategory info
try
{
	$sql = 'INSERT INTO subcategory SET
    subcategoryname = :subcategoryname,
    description = :description,
    subcategoryimageurl=:subcategoryimageurl,
    maincategoryid=:maincategoryid'; 
    $s = $pdo->prepare($sql);
    $s->bindValue(':subcategoryname',$_SESSION['subcategoryname'] );
    $s->bindValue(':description',$_SESSION['description'] );
    $s->bindValue(':subcategoryimageurl',$_SESSION['subcategoryimageurl'] );
    $s->bindValue(':maincategoryid',$_SESSION['maincategoryid'] );
    $s->execute();
}
catch (PDOException $e)
{
	$error = 'Error inserting new subcategory data : ' . $e->getMessage();
    include 'error.php';
    exit();
}
$subcategoryacknowledgement='A new subcategory has been added.<br>';
$maincategoryid=$_SESSION['maincategoryid'];
$maincategoryname=$_SESSION['maincategoryname'];
include 'subcategory.php';
exit();