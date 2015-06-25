<?php

if (!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["phone"]) && !empty($_POST["message"]))
{
	$name=	removeUnwanted($_POST['name']);
	$email=	removeUnwanted($_POST['email']);
	$phone=	removeUnwanted($_POST['phone']);
	$message= removeUnwanted($_POST['message']);

	if (strlen($name)>40) 
	{
		$nameerror= "Your name is too long. Please try again with a short name.";
		$name="";
		include "contact.php";
		exit();	
	}
	if (!preg_match("/^[a-zA-Z0-9\s]+$/",$name)) {
		$nameerror = "Please enter a valid name.";
		$name="";
		include "contact.php";
		exit();
	}
	if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email)>50)
	{
		$emailerror = "Invalid email format";
		$email="";
		include "contact.php";
		exit();		
	}
	if (!preg_match('/^02[0,1,7,8,9][0-9]{6,8}$/', $phone) && !preg_match('/^[0-9]{7}$/', $phone) && !preg_match('/^0(3|4|6|7|9)[0-9]{7}$/', $phone)) 
	{
		$phoneerror = "Invalid phone format";
		$phone="";
		include "contact.php";
		exit();		
	}
	$pattern = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
	if(preg_match($pattern, $message))
	{
		$messageerror = "Please don't include any hyperlinks";
		include "contact.php";
		exit();				
	}
	if(strlen($message)>500)
	{
		$messageerror = "Your message is too long. Please try to make it short";
		include "contact.php";
		exit();	
	}
	// $mailmessage="<b>User Information</b>".
	// "<br><br><b>Name :</b> ".$name.
	// "<br><br><b>Email :</b> ".$email.
	// "<br><br><b>Message :</b> ".$message.
	// "<br><br><b>Phone :</b> ".$phone;
	// $headers = "MIME-Version: 1.0" . "\r\n";
	// $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	// mail("grant.sherson@visioncollege.ac.nz", "User Information",$mailmessage,$headers);
	$acknowledgement="<p>Thank you ".$name.", your message has been successfully sent.</p>";
	
}
else
{
	$contactformerror="Please fill in all the fields.";
	include "contact.php";
	exit();
}