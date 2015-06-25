<?php 
//insert new maincategory info
try
{
	$sql = 'INSERT INTO maincategory SET
    maincategoryname = :maincategoryname,
    description = :description,
    maincategoryimageurl=:maincategoryimageurl'; 
    $s = $pdo->prepare($sql);
    $s->bindValue(':maincategoryname',$_SESSION['maincategoryname'] );
    $s->bindValue(':description',$_SESSION['description'] );
    $s->bindValue(':maincategoryimageurl',$_SESSION['maincategoryimageurl'] );
    $s->execute();
}
catch (PDOException $e)
{
	$error = 'Error inserting new main category data : ' . $e->getMessage();
    include 'error.php';
    exit();
}
$acknowledgement='A new main category has been added.<br>';
include 'home.php';
exit();