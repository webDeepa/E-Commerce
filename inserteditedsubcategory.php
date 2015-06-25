<?php 
//insert edited subcategory info
try
{
	$sql = 'UPDATE subcategory SET
    subcategoryname = :subcategoryname,
    description = :description,
    subcategoryimageurl=:subcategoryimageurl,
    maincategoryid=:maincategoryid
    where subcategoryid=:subcategoryid'; 
    $s = $pdo->prepare($sql);
    $s->bindValue(':subcategoryname',$_SESSION['subcategoryname'] );
    $s->bindValue(':description',$_SESSION['description'] );
    $s->bindValue(':subcategoryimageurl',$_SESSION['subcategoryimageurl'] );
    $s->bindValue(':maincategoryid',$_SESSION['maincategoryid'] );
    $s->bindValue(':subcategoryid',$_SESSION['subcategoryid'] );
    $s->execute();
}
catch (PDOException $e)
{
	$error = 'Error updating subcategory data : ' . $e->getMessage();
    include 'error.php';
    exit();
}
$subcategoryacknowledgement='A subcategory has been updated.<br>';
$maincategoryid=$_SESSION['maincategoryid'];
$maincategoryname=$_SESSION['maincategoryname'];
include 'subcategory.php';
exit();