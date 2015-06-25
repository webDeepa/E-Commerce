<?php 
//insert edited maincategory info
try
{
	$sql = 'UPDATE maincategory SET
    maincategoryname = :maincategoryname,
    description = :description,
    maincategoryimageurl=:maincategoryimageurl    
    where maincategoryid=:maincategoryid'; 
    $s = $pdo->prepare($sql);
    $s->bindValue(':maincategoryname',$_SESSION['maincategoryname'] );
    $s->bindValue(':description',$_SESSION['description'] );
    $s->bindValue(':maincategoryimageurl',$_SESSION['maincategoryimageurl'] );   
    $s->bindValue(':maincategoryid',$_SESSION['maincategoryid'] );
    $s->execute();
}
catch (PDOException $e)
{
	$error = 'Error updating main category data : ' . $e->getMessage();
    include 'error.php';
    exit();
}
$acknowledgement='A main category has been updated.<br>';
include 'home.php';
exit();