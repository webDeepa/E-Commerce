<?php
//insert new product info
try
{
	$sql = 'INSERT INTO size SET
    small = :small,
    medium = :medium,
    large=:large,
    extralarge = :extralarge'; 
    $s = $pdo->prepare($sql);
    $s->bindValue(':small',$_SESSION['small'] );
    $s->bindValue(':medium',$_SESSION['medium'] );
    $s->bindValue(':large',$_SESSION['large'] );
    $s->bindValue(':extralarge',$_SESSION['extralarge'] );
    $s->execute();
    $sizeid=$pdo->lastInsertId();
}
catch (PDOException $e)
{
	$error = 'Error inserting new product size data into size table: ' . $e->getMessage();
    include 'error.php';
    exit();
}
try
{
	$sql = 'INSERT INTO products SET
    productname = :productname,
    description = :description,
    productimageurl=:productimageurl,
    price =  :productprice,
	sizeid	= :sizeid,
    productkeywords = :productkeywords,
    subcategoryid=:subcategoryid'; 
    $s = $pdo->prepare($sql);
    $s->bindValue(':productname',$_SESSION['productname'] );
    $s->bindValue(':description',$_SESSION['description'] );
    $s->bindValue(':productimageurl',$_SESSION['productimageurl'] );
    $s->bindValue(':productprice',$_SESSION['productprice'] );
    $s->bindValue(':sizeid',$sizeid);
    $s->bindValue(':productkeywords',$_SESSION['pro-keywords']);
    $s->bindValue(':subcategoryid',$_SESSION['subcategoryid']);
    $s->execute();
}
catch (PDOException $e)
{
	$error = 'Error inserting new product data into products table: ' . $e->getMessage();
    include 'error.php';
    exit();
}
$productacknowledgement='A new product has been added.<br>';
$subcategoryid=$_SESSION['subcategoryid'];
$subcategoryname=$_SESSION['subcategoryname'];
include 'product.php';
exit();