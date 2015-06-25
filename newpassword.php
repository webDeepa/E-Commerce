<?php
if (!empty($_POST['oldpassword']) && !empty($_POST['newpassword'])) 
{
	$oldpassword=removeUnwanted($_POST['oldpassword']);
	$newpassword=removeUnwanted($_POST['newpassword']);
	$oldpassword=md5($oldpassword);
	$newpassword=md5($newpassword);
	session_start();
	if($_SESSION['password']==$oldpassword)
	{
		try
		{
			$sql = "UPDATE customers set password=:password
			where customerid=:customerid";
			$s = $pdo->prepare($sql);
			$s->bindValue(':password', $newpassword);
			$s->bindValue(':customerid', $_SESSION['customerid']);
			$s->execute();
		}
		catch (PDOException $e)
		{
			$error = 'Error inserting new password to the db: ' . $e->getMessage();
			include 'error.php';
			exit();
		}
		$acknowledgement="Your password has been changed.";
	}
	else
	{
		$passwordError="Your old password is incorrect. Please type again.";
		include 'changepasswordform.php';
		exit();
	}
}
else
{
	$passwordError='Please fill in both the fields';
	include 'changepasswordform.php';
	exit();
}