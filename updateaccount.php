<?php
if(!empty($_POST['fname'])&&!empty($_POST['lname']))
{
	$firstname=	removeUnwanted($_POST['fname']);
	$lastname=	removeUnwanted($_POST['lname']);
	$phone=	removeUnwanted($_POST['phone']);
	$address= removeUnwanted($_POST['address']);
	if (strlen($firstname)>40 || strlen($lastname)>40  ) 
	{
		$nameerror= "Your name is too long. Please try again with a short name.";
		$firstname=$lastname="";
		include "myaccountform.php";
		exit();	
	}
	if (!preg_match("/^[a-zA-Z0-9]+$/",$firstname) || !preg_match("/^[a-zA-Z0-9]+$/",$lastname)) {
		$nameerror = "Enter a valid name.";
		$firstname=$lastname="";
		include "myaccountform.php";
		exit();
	}
	if (!empty($phone)) {
		if (!preg_match('/^02[0,1,7,8,9][0-9]{6,8}$/', $phone) && !preg_match('/^[0-9]{7}$/', $phone) && !preg_match('/^0(3|4|6|7|9)[0-9]{7}$/', $phone)) 
		{
			$phoneerror = "Invalid phone format";
			$phone="";
			include "myaccountform.php";
			exit();		
		}
	}
	if (!empty($address)) {
		$pattern = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
		if(preg_match($pattern, $address))
		{
			$addresserror = "Please don't include any hyperlinks";
			include "myaccountform.php";
			exit();				
		}
		if(strlen($address)>200)
		{
			$addresserror = "Your message is too long. Please try to make it short";
			include "myaccountform.php";
			exit();	
		}
	}
	session_start();
	try
	{
		$sql = "UPDATE customers set firstname=:firstname,lastname=:lastname,phone=:phone ,address=:address
		where customerid=:customerid";
		$s = $pdo->prepare($sql);
		$s->bindValue(':firstname', $firstname);
		$s->bindValue(':lastname', $lastname);
		$s->bindValue(':phone', $phone);
		$s->bindValue(':address', $address);
		$s->bindValue(':customerid', $_SESSION['customerid']);
		$s->execute();
	}
	catch (PDOException $e)
	{
		$error = 'Error inserting edited customer data to the db: ' . $e->getMessage();
		include 'error.php';
		exit();
	}
	$acknowledgement="Your account information has been updated.<br>";
}
else
{
	$myaccountediterror="Please fill in the firstname and lastname field";
	include 'myaccountform.php';
	exit();
}