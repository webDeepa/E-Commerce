 <!DOCTYPE html>
<html>

<head>

<title>TREND</title>
<meta charset="utf-8" >
<link rel="stylesheet" type="text/css" href="./css/main.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body class="wrapper">
	<header>
	<section class="head_bg">
		<section class="headersection">
			<?php
				if(!isset($_SESSION)) 
			    { 
			        session_start(); 
			    } 
			?>
			<form action="" method="post" id="logoform">
				<button type="submit" name="home" class="logobtn linklook">	
					<img src="./img/logo.png" id="logo">
				</button>
			</form>
			<button type="button" name="menu"  id="menu"></button>
			<button type="submit" name="searchicon" class="btn" id="searchicon"></button>
			<form action="" method="post" id="searchform">
				<input type="text" name="searchtext" class="inputfield" placeholder="SEARCH" id="searchtext">
				<button type="submit" name="search" class="btn" id="search"></button>
			</form>
			
			
			<form id="menulist" action="" method="post">
				<button type="button" class="menuitem" id="close" name="close">X</button><br>
				<div class="clearfix"></div>
				<button type="submit" class="menuitem" id="mobileHome" name="home">Category</button><br>
				
				
				<button type="submit" class="menuitem" id="mobileWishlist" name="addtowishlist">Wish List</button><br>
				<button type="submit" class="menuitem" id="mobileCart" name="addtocart">Cart</button><br>
				<button type="submit" class="menuitem" id="mobileContact" name="contact">Contact</button><br>
				<?php
				
					if (isset($_SESSION['loggedIn'])) 
					{						
						echo '<button type="submit" class="menuitem" id="mobileaccount" name="myaccount">My Account</button><br>';
						echo '<button type="submit" class="menuitem" id="mobileLogin" name="logoutform">Log Out</button><br>';
					}
					else
					{
						echo'<button type="submit" class="menuitem" id="mobileLogin" name="loginform">Log In</button><br>
						<button type="submit" class="menuitem" id="mobileSignup" name="signupform">Sign Up</button><br>';
					}
				?>
			</form>
			<section id="menusection">
				
				<form id="userstatus" action="" method="post">
					<button type="submit" class="userinfo" id="wishlist" name="addtowishlist">Wish List</button>
					<button type="submit" class="userinfo" id="cart" name="addtocart">Cart</button>
					<button type="submit" class="userinfo" id="contact" name="contact">Contact</button>
					<?php

					if (isset($_SESSION['loggedIn'])) 
					{
						echo '<button type="submit" class="userinfo" id="account" name="myaccount">My Account</button>';
						echo '<button type="submit" class="userinfo" id="login" name="logoutform">Log Out</button>';

					}
					else
					{
						echo '<button type="submit" class="userinfo" id="login" name="loginform">Log In</button>
					<button type="submit" class="userinfo" id="signup" name="signupform">Sign Up</button>';
					}
					?>
					
				</form>
			</section>	
					
		</section>
		</section>	
	</header>
	<section class="sec_nav">
		<section class="sec_nav_sect">
		<?php
			try
			{
				$sql = 'SELECT * FROM maincategory';
				$s = $pdo->prepare($sql);
				$s->execute();
			}
			catch (PDOException $e)
			{
				$error = 'Error fetching records in maincategory table from database: ' . $e->getMessage();
				include 'error.php';
				exit();
			}
			foreach ($s as $row)
			{
				$hd_maincategories[] = array(
				'maincategoryid'=>$row['maincategoryid'],
				'maincategoryname'=>$row['maincategoryname']
				);
			}?>
			
			<?php foreach ($hd_maincategories as $maincategory):?>
				
					<form action="" method="post" class="sec_nav_form">
					    <input type="hidden" name="maincategoryid" value="<?php echo $maincategory['maincategoryid'];?>">
					    <input type="hidden" name="maincategoryname" value="<?php echo $maincategory['maincategoryname'];?>">
						<button type="submit" name="maincategory" class="btnnav" ><?php echo $maincategory['maincategoryname'];?></button>
					</form>
				
			<?php endforeach ?>
		<div class="clearfix"></div>	
		</section>
	</section>
	<br>
	<section class="search_bg" id="searchdetail">
		<button class="linklook" id="s_close">x</button>
		<form action="" method="post" id="mobilesearchform">
			<input type="text" name="searchtext" class="inputfield" placeholder="SEARCH" id="searchtext">
			<button type="submit" name="search" class="btn" id="search"></button>
		</form>
	</section>
<div class="clearfix"></div>
	<main class="main">
		<article class="container" >
		
			
			
	
