<?php 
//insert edited product info
try
{
	$sql = 'UPDATE products SET
    productname = :productname,
    description = :description,
    productimageurl=:productimageurl,
    productkeywords = :productkeywords,
    price=:productprice
    where productid=:productid'; 
    $s = $pdo->prepare($sql);
    $s->bindValue(':productname',$_SESSION['productname'] );
    $s->bindValue(':description',$_SESSION['description'] );
    $s->bindValue(':productimageurl',$_SESSION['productimageurl'] );
    $s->bindValue(':productprice',$_SESSION['productprice'] );
    $s->bindValue(':productkeywords',$_SESSION['pro-keywords']);
    $s->bindValue(':productid',$_SESSION['productid'] );
    $s->execute();
}
catch (PDOException $e)
{
	$error = 'Error updating product data : ' . $e->getMessage();
    include 'error.php';
    exit();
}
$productacknowledgement='A product has been updated';
$subcategoryid=$_SESSION['subcategoryid'];
$subcategoryname=$_SESSION['subcategoryname'];
include 'product.php';
exit();