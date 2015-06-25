<?php

if(!empty($_POST['email']) and !empty($_POST['password']))
{
	
	$useremail=	removeUnwanted($_POST['email']);
	$userpassword=	removeUnwanted($_POST['password']);

	if (!filter_var($useremail, FILTER_VALIDATE_EMAIL) || strlen($useremail)>50)
	{
		$emailError = "Invalid email format";
		include "loginform.php";
		exit();			
	}
	if (strlen($userpassword)>20) {
		$passwordError = "Your password is too long. Please try again.";
		include "loginform.php";
		exit();	
	}
	$userpassword=	md5($userpassword);
	try
	{
		$sql = 'select * from customers where email=:email and password=:password';
		$s = $pdo->prepare($sql);
		$s->bindValue(':email', $useremail);
		$s->bindValue(':password', $userpassword);
		$s->execute();
	}
	catch (PDOException $e)
	{
		$error = 'Error getting logindata from the db : ' . $e->getMessage();
		include 'error.php';
		exit();
	}

	
	if ($row = $s->fetch())
	{
		$customerid=$row['customerid'];
		$firstname=$row['firstname'];
		$lastname=$row['lastname'];
		$name=$firstname." ".$lastname;
		session_start();
		$_SESSION['name']=$name;
		$_SESSION['password'] = $userpassword;
		$_SESSION['address'] =$row['address']; 
		$_SESSION['phone'] = $row['phone'];
		$_SESSION['customerid'] = $customerid;
		$_SESSION['loggedIn'] = TRUE;
		//Admin page display
		if ($useremail=="robert@gmail.com") {
			$_SESSION['admin'] = TRUE;
		}
		if (isset($_SESSION['cart'])) {
			include 'shoppingcart.php';
			exit();
		}
		if (isset($_SESSION['wishlist'])) {
			include 'wishlist.php';
			exit();
		}
		
	}
	else
	{
		$loginerror="Incorrect email or password. Please try again.";
		include "loginform.php";
		exit();
	}
}
else
{
	$loginerror="Please fill in all the fields.";
	include "loginform.php";
	exit();
}