<?php

if(!empty($_POST['email']) and !empty($_POST['password']) and !empty($_POST['fname']) and !empty($_POST['lname']))
{
	$firstname=	removeUnwanted($_POST['fname']);
	$lastname=	removeUnwanted($_POST['lname']);
	$useremail=	removeUnwanted($_POST['email']);
	$userpassword=	removeUnwanted($_POST['password']);

	if (strlen($firstname)>40 || strlen($lastname)>40 ) {
		$signuperror = "Your name is too long. Please try again with a short name.";
		$firstname=$lastname="";
		include "signupform.php";
		exit();	
	}
	if ( !preg_match("/^[a-zA-Z0-9]+$/",$firstname)|| !preg_match("/^[a-zA-Z0-9]+$/",$lastname)) {
		$signuperror = "Enter a valid name.";
		$firstname=$lastname="";
		include "signupform.php";
		exit();	
	}

	if (!filter_var($useremail, FILTER_VALIDATE_EMAIL) || strlen($useremail)>50)
	{
		$signuperror = "Invalid email format";
		include "signupform.php";
		exit();			
	}

	if (strlen($userpassword)>20) {
		$signuperror = "Your password is too long. Please try again.";
		include "signupform.php";
		exit();	
	}

	$userpassword=	md5($userpassword);

	try
	{
		$sql = 'select * from customers where email=:email';
		$s = $pdo->prepare($sql);
		$s->bindValue(':email', $useremail);
		$s->execute();
	}
	catch (PDOException $e)
	{
		$error = 'Error getting data from the db to check for registeration: ' . $e->getMessage();
		include 'error.php';
		exit();
	}

	if ($row = $s->fetch())
	{		
		$signuperror="This email already exists. Please enter a different email address.";
		$useremail="";
		include "signupform.php";
		exit();
	}
	try
	{
		$sql2 = 'INSERT INTO customers set firstname=:firstname,lastname=:lastname,email=:email ,password=:password';
		$s2 = $pdo->prepare($sql2);
		$s2->bindValue(':firstname', $firstname);
		$s2->bindValue(':lastname', $lastname);
		$s2->bindValue(':email', $useremail);
		$s2->bindValue(':password', $userpassword);
		$s2->execute();
		$customerlastid=$pdo->lastInsertId();
	}
	catch (PDOException $e)
	{
		$error = 'Error inserting data to the db for registering : ' . $e->getMessage();
		include 'error.php';
		exit();
	}
	$username=$firstname." ".$lastname;
	session_start();
	$_SESSION['name']=$username;
	$_SESSION['password'] = $userpassword;
	$_SESSION['loggedIn'] = TRUE;
	$_SESSION['customerid']=$customerlastid;
	
}
else
{
	$firstname=	removeUnwanted($_POST['fname']);
	$lastname=	removeUnwanted($_POST['lname']);
	$useremail=	removeUnwanted($_POST['email']);
	$signuperror="Please fill in all the fields.";
	include "signupform.php";
	exit();
}