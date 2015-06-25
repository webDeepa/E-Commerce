<?php
if(!empty($_POST['deliverytype']) && !empty($_POST['shippingname']) && !empty($_POST['shippingaddress']) && !empty($_POST['billingaddress']) && !empty($_POST['shippingphone']))
{
	$deliverytype=removeUnwanted($_POST['deliverytype']);
	$shippingname=removeUnwanted($_POST['shippingname']);
	$shippingaddress=removeUnwanted($_POST['shippingaddress']);
	$billingaddress=removeUnwanted($_POST['billingaddress']);
	$shippingphone=removeUnwanted($_POST['shippingphone']);
	//verification
	if (strlen($shippingname)>40) 
	{
		$shippingerror= "Your name is too long. Please try again with a short name.";
		$shippingname="";
		include "shippingdetailsform.php";
		exit();	
	}
	if (!preg_match("/^[a-zA-Z0-9\s]+$/",$shippingname)) 
	{
		$shippingerror = "Enter a valid name.";
		$shippingname="";
		include "shippingdetailsform.php";
		exit();
	}
	if (!preg_match('/^02[0,1,7,8,9][0-9]{6,8}$/', $shippingphone) && !preg_match('/^[0-9]{7}$/', $shippingphone) && !preg_match('/^0(3|4|6|7|9)[0-9]{7}$/', $shippingphone)) 
	{
		$shippingerror = "Invalid phone format";
		$shippingphone="";
		include "shippingdetailsform.php";
		exit();		
	}
	$pattern = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
	if(preg_match($pattern, $shippingaddress) || preg_match($pattern, $billingaddress) )
	{
		$shippingerror = "Please don't include any hyperlinks";
		include "shippingdetailsform.php";
		exit();				
	}
	if(strlen($shippingaddress)>200 || strlen($billingaddress)>200 )
	{
		$shippingerror = "Your message is too long. Please try to make it short";
		include "shippingdetailsform.php";
		exit();	
	}
	session_start();
	$_SESSION['deliverytype']=$deliverytype;
	$_SESSION['shippingname']=$shippingname;
	$_SESSION['shippingaddress']=$shippingaddress;
	$_SESSION['billingaddress']=$billingaddress;
	$_SESSION['shippingphone']=$shippingphone;
	//insert the billingaddress and the phonenumber into customers table
	try
	{
		$sql2 = 'UPDATE customers set phone=:phone,address=:address
		where customerid=:customerid';
		$s2 = $pdo->prepare($sql2);
		$s2->bindValue(':phone', $shippingphone);
		$s2->bindValue(':address', $billingaddress);
		$s2->bindValue(':customerid', $_SESSION['customerid']);
		$s2->execute();
	}
	catch (PDOException $e)
	{
		$error = 'Error inserting phone and address data into customers table in the db: ' . $e->getMessage();
		include 'error.php';
		exit();
	}
	include 'payment.php';
	exit();
}
else
{
	$shippingerror='Please fill in all the fields';
	include 'shippingdetailsform.php';
	exit();
}