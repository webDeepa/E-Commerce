<?php
$nameError=$quantity=$useremail=$emailError=$passwordError=$loginerror=$firstname=$lastname=$signuperror=$logoutinfo=$quantityerror=$sizeerror="";
$display=TRUE;
$nameerror=$emailerror=$phoneerror=$messageerror=$contactformerror=$name=$email=$phone=$message=$acknowledgement= $editproducterror=$addproducterror="";
$myaccountediterror=$addresserror=$address=$shippingerror=$admincategoryerror=$imageuploaderror=$subcategoryacknowledgement=$productacknowledgement="";
include_once 'include/dbconnection.php';
//function to sanitise user's input	
function removeUnwanted($userinput)
{
   $userinput = trim($userinput);
   $userinput = stripslashes($userinput);
   $userinput = htmlspecialchars($userinput,ENT_QUOTES,'UTF-8');
   return $userinput;
}
//privacy policy
if (isset($_POST['prvcy-plcy'])) 
{
	include 'privacypolicy.php';
	exit();
}
//terms and condition
if (isset($_POST['trm-condt'])) 
{
	include 'termsandconditions.php';
	exit();
}
//full text search 
if (isset($_POST['search'])) 
{
	include 'fulltextsearch.php';
	exit();
}
//Admin delete product
if (isset($_POST['deleteproduct'])) 
{
	$productid=$_POST['productid'];
	session_start();
	$_SESSION['subcategoryid']=$_POST['subcategoryid'];
	$_SESSION['subcategoryname']=$_POST['subcategoryname'];
	//delete product from wishlist table
	try
	{		
		$sql = 'DELETE FROM wishlist 
		where productid=:productid';
		$s = $pdo->prepare($sql);
		$s->bindValue(':productid', $productid);
		$s->execute();
	}
	catch (PDOException $e)
	{
		$error = 'Error deleting wishlist data : ' . $e->getMessage();
	    include 'error.php';
	    exit();
	}
	//delete product from produtcs table
	try
	{		
		$sql = 'DELETE FROM products 
		where productid=:productid';
		$s = $pdo->prepare($sql);
		$s->bindValue(':productid', $productid);
		$s->execute();
	}
	catch (PDOException $e)
	{
		$error = 'Error deleting product data : ' . $e->getMessage();
	    include 'error.php';
	    exit();
	}
	$productacknowledgement='One product has been deleted';
	$subcategoryid=$_SESSION['subcategoryid'];
	$subcategoryname=$_SESSION['subcategoryname'];
	include 'product.php';
	exit();
}

//Admin add product

if (isset($_POST['addproduct'])) 
{
	session_start();
	$_SESSION['addproduct']=TRUE;
	if (isset($_SESSION['editmaincategory'])) {
		unset($_SESSION['editmaincategory']);
	}
	if (isset($_SESSION['addmaincategory'])) {
		unset($_SESSION['addmaincategory']);
	}
	if (isset($_SESSION['addsubcategory'])) {
		unset($_SESSION['addsubcategory']);
	}
	if (isset($_SESSION['editsubcategory'])) {
		unset($_SESSION['editsubcategory']);
	}
	if (isset($_SESSION['editproduct'])) {
		unset($_SESSION['editproduct']);
	}
	$_SESSION['subcategoryname']= $_POST['subcategoryname'];
	$_SESSION['subcategoryid']= $_POST['subcategoryid'];
	$_SESSION['productname']="";
	$_SESSION['productimageurl']="";
	$_SESSION['description']= "";
	$_SESSION['pro-keywords']= "";
	$_SESSION['productprice']= "";
	$_SESSION['small']="";
	$_SESSION['medium']="";
	$_SESSION['large']="";
	$_SESSION['extralarge']="";
	include 'addproductform.php';
	exit();
}
if (isset($_POST['addproductsubmit'])) 
{
	if (!empty($_POST['productname']) && !empty($_POST['description']) && !empty($_POST['productprice']) && !empty($_POST['pro-keywords'])) 
	{
		session_start();
		$productname=removeUnwanted($_POST['productname']);
		$description=removeUnwanted($_POST['description']);
		$_SESSION['productprice']= removeUnwanted($_POST['productprice']);
		$_SESSION['productname']=$productname;
		$_SESSION['description']= $description;
		$_SESSION['small']=removeUnwanted($_POST['small']);
		$_SESSION['medium']=removeUnwanted($_POST['medium']);
		$_SESSION['large']=removeUnwanted($_POST['large']);
		$_SESSION['extralarge']=removeUnwanted($_POST['extralarge']);
		$_SESSION['pro-keywords']=removeUnwanted($_POST['pro-keywords']);
		//validation
		if (strlen($productname)>60 || !preg_match("/^[a-zA-Z0-9\s-]+$/",$productname)) {
			$addproducterror="Please enter a valid main category name. Make sure it's not too long.";
			include 'addproductform.php';
			exit();
		}
		if (strlen($description)>200) {
			$addproducterror="Please make sure the description is not too long.";
			include 'addproductform.php';
			exit();
		}
		if ($_SESSION['small']==0 and $_SESSION['medium']==0 and $_SESSION['large']==0 and $_SESSION['extralarge']==0)
		{
			$addproducterror="If there is no stock, you cannot add a product. Please check the size availability before adding a product.";
			include 'addproductform.php';
			exit();
		}
		if ($_SESSION['productprice']<1 || $_SESSION['productprice']>200 ) {
			$addproducterror="Please enter a valid price.";
			include 'addproductform.php';
			exit();
		}
		if (strlen($_SESSION['pro-keywords'])>200) {
			$addproducterror="Please make sure the product keywords are not too long.";
			include 'addproductform.php';
			exit();
		}
		include 'uploadimage.php';
		exit();
	}
	else
	{
		$addproducterror="Please fill in all the fields";
		include 'addproductform.php';
		exit();
	}
}

//Admin edit product
if (isset($_POST['editproduct'])) 
{
	session_start();
	$_SESSION['editproduct']=TRUE;
	if (isset($_SESSION['addmaincategory'])) {
		unset($_SESSION['addmaincategory']);
	}
	if (isset($_SESSION['addsubcategory'])) {
		unset($_SESSION['addsubcategory']);
	}
	if (isset($_SESSION['addproduct'])) {
		unset($_SESSION['addproduct']);
	}
	if (isset($_SESSION['editmaincategory'])) {
		unset($_SESSION['editmaincategory']);
	}
	if (isset($_SESSION['editsubcategory'])) {
		unset($_SESSION['editsubcategory']);
	}
	$_SESSION['subcategoryname']= $_POST['subcategoryname'];
	$_SESSION['subcategoryid']= $_POST['subcategoryid'];
	$_SESSION['productid']= $_POST['productid'];
	$_SESSION['productname']=$_POST['productname'];
	$_SESSION['productimageurl']= $_POST['productimageurl'];
	$_SESSION['description']= $_POST['description'];
	$_SESSION['pro-keywords']= $_POST['pro-keywords'];
	$_SESSION['productprice']= $_POST['productprice'];
	include 'editproductform.php';
	exit();
}
if (isset($_POST['editproductsubmit'])) 
{
	if (!empty($_POST['productname']) && !empty($_POST['productdescription']) && !empty($_POST['productprice']) && !empty($_POST['editimage'])) 
	{
		$productname=removeUnwanted($_POST['productname']);
		$productprice=removeUnwanted($_POST['productprice']) ;
		$productdescription=removeUnwanted($_POST['productdescription']);
		$productkeywords=removeUnwanted($_POST['pro-keywords']);
		$editimage=removeUnwanted($_POST['editimage']);
		//validation
		if (strlen($productname)>60 || !preg_match("/^[a-zA-Z0-9\s-]+$/",$productname)) {
			$editproducterror="Please enter a valid product name. Make sure it's not too long.";
			include 'editproductform.php';
			exit();
		}
		if (strlen($productdescription)>200) {
			$editproducterror="Please make sure the description is not too long.";
			include 'editproductform.php';
			exit();
		}
		if (strlen($productkeywords)>200) {
			$editproducterror="Please make sure the product keywords is not too long.";
			include 'editproductform.php';
			exit();
		}
		if ($productprice<1 || $productprice>200 ) {
			$editproducterror="Please enter a valid price.";
			include 'editproductform.php';
			exit();
		}
		session_start();
		$_SESSION['productname']=$productname;
		$_SESSION['description']= $productdescription;
		$_SESSION['productprice']= $productprice;
		$_SESSION['pro-keywords']=$productkeywords;
		if ($editimage=="uploadimage") {
			include 'uploadimage.php';
			exit();
		}
		else
		{
			include 'inserteditedproduct.php';
			exit();
		}
	}
	else
	{
		$editproducterror="Please fill in all the fields";
		include 'editproductform.php';
		exit();
	}
}
//Admin add subcategory
if (isset($_POST['addsubcategory'])) 
{
	session_start();
	$_SESSION['addsubcategory']=TRUE;
	if (isset($_SESSION['editmaincategory'])) {
		unset($_SESSION['editmaincategory']);
	}
	if (isset($_SESSION['addmaincategory'])) {
		unset($_SESSION['addmaincategory']);
	}
	if (isset($_SESSION['addproduct'])) {
		unset($_SESSION['addproduct']);
	}
	if (isset($_SESSION['editsubcategory'])) {
		unset($_SESSION['editsubcategory']);
	}
	if (isset($_SESSION['editproduct'])) {
		unset($_SESSION['editproduct']);
	}
	$_SESSION['maincategoryid']=$_POST['maincategoryid'];
	$_SESSION['subcategoryid']= "";
	$_SESSION['subcategoryname']="";
	$_SESSION['subcategoryimageurl']= "";
	$_SESSION['description']="";
	$_SESSION['heading']="Add subcategory";
	$_SESSION['namefield']="Subcategory name";
	include 'admincategoryform.php';
	exit();
}
if (isset($_POST['addsubcategorysubmit'])) 
{
	if (!empty($_POST['name']) && !empty($_POST['description'])) 
	{
		$subcategoryname=removeUnwanted($_POST['name']);
		$subcategorydescription=removeUnwanted($_POST['description']);
		//validation
		if (strlen($subcategoryname)>60 || !preg_match("/^[a-zA-Z0-9\s-]+$/",$subcategoryname)) {
			$admincategoryerror="Please enter a valid main category name. Make sure it's not too long.";
			include 'admincategoryform.php';
			exit();
		}
		if (strlen($subcategorydescription)>200) {
			$admincategoryerror="Please make sure the description is not too long.";
			include 'admincategoryform.php';
			exit();
		}
		session_start();
		$_SESSION['subcategoryname']=$subcategoryname;
		$_SESSION['description']= $subcategorydescription;
		include 'uploadimage.php';
		exit();
	}
	else
	{
		$admincategoryerror="Please fill in all the fields";
		include 'admincategoryform.php';
		exit();
	}
}
//Admin edit subcategory
if (isset($_POST['editsubcategory'])) 
{
	session_start();
	$_SESSION['editsubcategory']=TRUE;
	if (isset($_SESSION['addmaincategory'])) {
		unset($_SESSION['addmaincategory']);
	}
	if (isset($_SESSION['addsubcategory'])) {
		unset($_SESSION['addsubcategory']);
	}
	if (isset($_SESSION['addproduct'])) {
		unset($_SESSION['addproduct']);
	}
	if (isset($_SESSION['editmaincategory'])) {
		unset($_SESSION['editmaincategory']);
	}
	if (isset($_SESSION['editproduct'])) {
		unset($_SESSION['editproduct']);
	}
	$_SESSION['maincategoryid']= $_POST['maincategoryid'];
	$_SESSION['maincategoryname']= $_POST['maincategoryname'];
	$_SESSION['subcategoryid']= $_POST['subcategoryid'];
	$_SESSION['subcategoryname']=$_POST['subcategoryname'];
	$_SESSION['subcategoryimageurl']= $_POST['subcategoryimageurl'];
	$_SESSION['description']= $_POST['subcategorydescription'];
	$_SESSION['heading']= "Edit subcategory";
	$_SESSION['namefield']="Subcategory name";
	include 'admincategoryform.php';
	exit();
}
if (isset($_POST['editsubcategorysubmit'])) 
{
	if (!empty($_POST['name']) && !empty($_POST['description'])  && !empty($_POST['editimage'])) 
	{
		$subcategoryname=removeUnwanted($_POST['name']);
		
		$subcategorydescription=removeUnwanted($_POST['description']);
		$editimage=removeUnwanted($_POST['editimage']);
		//validation
		if (strlen($subcategoryname)>60 || !preg_match("/^[a-zA-Z0-9\s-]+$/",$subcategoryname)) {
			$admincategoryerror="Please enter a valid main category name. Make sure it's not too long.";
			include 'admincategoryform.php';
			exit();
		}
		if (strlen($subcategorydescription)>200) {
			$admincategoryerror="Please make sure the description is not too long.";
			include 'admincategoryform.php';
			exit();
		}
		session_start();
		$_SESSION['subcategoryname']=$subcategoryname;
		$_SESSION['description']= $subcategorydescription;
		if ($editimage=="uploadimage") {
			include 'uploadimage.php';
			exit();
		}
		else
		{
			include 'inserteditedsubcategory.php';
			exit();
		}
	}
	else
	{
		$admincategoryerror="Please fill in all the fields";
		include 'admincategoryform.php';
		exit();
	}

}
//Admin add maincategory 
if (isset($_POST['addmaincategory'])) 
{
	session_start();
	$_SESSION['addmaincategory']=TRUE;
	if (isset($_SESSION['editmaincategory'])) {
		unset($_SESSION['editmaincategory']);
	}
	if (isset($_SESSION['addsubcategory'])) {
		unset($_SESSION['addsubcategory']);
	}
	if (isset($_SESSION['addproduct'])) {
		unset($_SESSION['addproduct']);
	}
	if (isset($_SESSION['editsubcategory'])) {
		unset($_SESSION['editsubcategory']);
	}
	if (isset($_SESSION['editproduct'])) {
		unset($_SESSION['editproduct']);
	}
	$_SESSION['maincategoryid']= "";
	$_SESSION['maincategoryname']="";
	
	$_SESSION['maincategoryimageurl']= "";
	$_SESSION['description']="";
	$_SESSION['heading']="Add main category";
	$_SESSION['namefield']="Main category name";
	include 'admincategoryform.php';
	exit();
}
if (isset($_POST['addmaincategorysubmit'])) 
{
	if (!empty($_POST['name']) && !empty($_POST['description'])) 
	{
		$maincategoryname=removeUnwanted($_POST['name']);
		
		$maincategorydescription=removeUnwanted($_POST['description']);
		//validation
		if (strlen($maincategoryname)>60 || !preg_match("/^[a-zA-Z0-9\s-]+$/",$maincategoryname)) {
			$admincategoryerror="Please enter a valid main category name. Make sure it's not too long.";
			include 'admincategoryform.php';
			exit();
		}
		if (strlen($maincategorydescription)>200) {
			$admincategoryerror="Please make sure the description is not too long.";
			include 'admincategoryform.php';
			exit();
		}
		session_start();
		$_SESSION['maincategoryname']=$maincategoryname;
		
		$_SESSION['description']= $maincategorydescription;
		include 'uploadimage.php';
		exit();
	}
	else
	{
		$admincategoryerror="Please fill in all the fields";
		include 'admincategoryform.php';
		exit();
	}
}

//Admin edit maincategory 
if (isset($_POST['editmaincategory'])) 
{
	session_start();
	$_SESSION['editmaincategory']=TRUE;
	if (isset($_SESSION['addmaincategory'])) {
		unset($_SESSION['addmaincategory']);
	}
	if (isset($_SESSION['addsubcategory'])) {
		unset($_SESSION['addsubcategory']);
	}
	if (isset($_SESSION['addproduct'])) {
		unset($_SESSION['addproduct']);
	}
	if (isset($_SESSION['editsubcategory'])) {
		unset($_SESSION['editsubcategory']);
	}
	if (isset($_SESSION['editproduct'])) {
		unset($_SESSION['editproduct']);
	}
	$_SESSION['maincategoryid']= $_POST['maincategoryid'];
	$_SESSION['maincategoryname']=$_POST['maincategoryname'];
	
	$_SESSION['maincategoryimageurl']= $_POST['maincategoryimageurl'];
	$_SESSION['description']= $_POST['description'];
	$_SESSION['heading']="Edit main category";
	$_SESSION['namefield']="Main category name";
	include 'admincategoryform.php';
	exit();
}
if (isset($_POST['editmaincategorysubmit'])) 
{
	if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['editimage'])) 
	{
		$maincategoryname=removeUnwanted($_POST['name']);
		$maincategorydescription=removeUnwanted($_POST['description']);
		$editimage=removeUnwanted($_POST['editimage']);
		//validation
		if (strlen($maincategoryname)>60 || !preg_match("/^[a-zA-Z0-9\s-]+$/",$maincategoryname)) {
			$admincategoryerror="Please enter a valid main category name. Make sure it's not too long.";
			include 'admincategoryform.php';
			exit();
		}
		if (strlen($maincategorydescription)>200) {
			$admincategoryerror="Please make sure the description is not too long.";
			include 'admincategoryform.php';
			exit();
		}
		session_start();
		$_SESSION['maincategoryname']=$maincategoryname;
		$_SESSION['description']= $maincategorydescription;
		if ($editimage=="uploadimage") {
			include 'uploadimage.php';
			exit();
		}
		else
		{
			include 'inserteditedmaincategory.php';
			exit();
		}
	}
	else
	{
		$admincategoryerror="Please fill in all the fields";
		include 'admincategoryform.php';
		exit();
	}

}
// Admin upload image
if (isset($_POST['upload'])) {
	include 'uploadimagesubmit.php';
	exit();
}

//Inserting session data into db and displaying invoice.
if (isset($_POST['pay'])) {
	//inserting data into orders table
	session_start();
	try
	{
		$sql = 'INSERT INTO orders SET 
		orderdate= CURDATE(),
		customerid=:customerid,
		transactionstatus="paid",
		shippingname=:shippingname,
		shippingaddress=:shippingaddress,
		billingaddress=:billingaddress,
		deliverytype=:deliverytype,
		phonenumber=:phonenumber';
		$s = $pdo->prepare($sql);
		$s->bindValue(':customerid', $_SESSION['customerid']);
		$s->bindValue(':shippingname', $_SESSION['shippingname']);
		$s->bindValue(':shippingaddress', $_SESSION['shippingaddress']);
		$s->bindValue(':billingaddress', $_SESSION['billingaddress']);
		$s->bindValue(':deliverytype', $_SESSION['deliverytype']);
		$s->bindValue(':phonenumber', $_SESSION['shippingphone']);
		$s->bindValue(':phonenumber', $_SESSION['shippingphone']);
		$s->execute();
		$lastordernumber=$pdo->lastInsertId();
		$_SESSION['lastordernumber']=$lastordernumber;
	}
	catch (PDOException $e)
	{
		$error = 'Error inserting data into orders table: ' . $e->getMessage();
		include 'error.php';
		exit();
	}
	//inserting data into orderdetails table	
	foreach($_SESSION['items'] as $item)
	{
		try
		{
			$sql = 'INSERT INTO orderdetails (ordernumber,productid,productname,productdescription,size,price,quantity,subtotal) 
			VALUES (:ordernumber,:productid,:productname,:productdescription,:size,:price,:quantity,:subtotal);';
			$s = $pdo->prepare($sql);
			$s->bindValue(':ordernumber', $lastordernumber);
			$s->bindValue(':productid',$item['productid'] );
			$s->bindValue(':productname',$item['productname']);
			$s->bindValue(':productdescription',$item['productdescription'] );
			$s->bindValue(':size', $item['size']);
			$s->bindValue(':price',$item['unitprice'] );
			$s->bindValue(':quantity',$item['quantity']);
			$s->bindValue(':subtotal',$item['subtotal']);
			$s->execute();
		}
		catch (PDOException $e)
		{
			$error = 'Error inserting data into orderdetails table: ' . $e->getMessage();
			include 'error.php';
			exit();
		}
	}
	//reduce the number of items being sold from the available stock
	foreach($_SESSION['items'] as $item)
	{
		try
		{
			$sql = 'SELECT * from size 
			inner join products 
			on products.sizeid=size.sizeid
			where products.productid=:productid';
			$s = $pdo->prepare($sql);
			$s->bindValue(':productid',$item['productid']);
			$s->execute();
		}
		catch (PDOException $e)
		{
			$error = 'Error selecting size data from  size table: ' . $e->getMessage();
			include 'error.php';
			exit();
		}
		foreach ($s as $row)
		{
			
			$current_small = $row['small'];
			$current_medium= $row['medium'];
			$current_large = $row['large'];
			$current_x_large=$row['extralarge'];
			$sizeid = $row['sizeid'];
			
		}
		if ($item['size']=="small") {
			$current_small=$current_small-$item['quantity'];
		}
		if($item['size']=="medium")
		{
			$current_medium=$current_medium-$item['quantity'];
		}
		if ($item['size']=="large") {
			$current_large=$current_large-$item['quantity'];
		}
		if ($item['size']=="extralarge") {
			$current_x_large=$current_x_large-$item['quantity'];
		}

		try
		{
			$sql='UPDATE size SET
			small=:small,
			medium=:medium,
			large=:large,
			extralarge=:extralarge
			where sizeid=:sizeid';
			$s = $pdo->prepare($sql);
			$s->bindValue(':sizeid',$sizeid);
			$s->bindValue(':small',$current_small);
			$s->bindValue(':medium',$current_medium);
			$s->bindValue(':large',$current_large);
			$s->bindValue(':extralarge',$current_x_large);
			$s->execute();
		}
		catch (PDOException $e)
		{
			$error = 'Error updating size data in size table: ' . $e->getMessage();
			include 'error.php';
			exit();
		}
	}
	include 'invoice.php';
	//empty cart
	unset($_SESSION['items']);
	unset($_SESSION['productid']);
	exit();
}
if (isset($_POST['shippingsubmit'])) {
	include 'shippingverification.php';
	exit();
}
if (isset($_POST['proceedtocheckout'])) {
	include 'shippingdetailsform.php';
	exit();
}
if (isset($_POST['changepasswordsubmit'])) {
	include 'newpassword.php';
}
if (isset($_POST['changepassword'])) {
	include 'changepasswordform.php';
	exit();
}
//verify and insert edited user info into db
if (isset($_POST['updateaccount'])) {
	include 'updateaccount.php';
}
if (isset($_POST['editinformation'])) {
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$phone=$_POST['phone'];
	$address=$_POST['address'];
	include 'myaccountform.php';
	exit();
}
if (isset($_POST['myaccount'])) {
	include 'myaccount.php';
	exit();
}
if (isset($_POST['send'])) {
	include 'contactverification.php';
}
if (isset($_POST['contact'])) {
	include 'contact.php';
	exit();
}
if(isset($_POST['movetowishlist']))
{
	$itemid=$_POST['productid'];
	session_start();
	$_SESSION['productid']=$_POST['productid'];
	$display=FALSE;
	include 'wishlist.php';
	unset($_SESSION['items'][$itemid]) ;
	unset($_SESSION['productid']);
	include 'shoppingcart.php';
	exit();
}
if(isset($_POST['removefromwishlist']))
{
	session_start();
	$_SESSION['productid']=$_POST['productid'];
	try
	{
		$sql = 'DELETE FROM wishlist WHERE customerid=:customerid and productid=:productid';
		$s = $pdo->prepare($sql);
		$s->bindValue(':customerid', $_SESSION['customerid']);
		$s->bindValue(':productid', $_SESSION['productid']);
		$s->execute();
	}
	catch (PDOException $e)
	{
		$error = 'Error deleting product and customer data in the database: ' . $e->getMessage();
		include 'error.php';
		exit();
	}
	unset($_SESSION['productid']);
	include 'wishlist.php';
	exit();
}

if (isset($_POST['addtowishlist'])) 
{
	session_start();
	if (!isset($_SESSION['wishlist']))
	{
		$_SESSION['wishlist'] = TRUE;
	}
	if (isset($_POST['productid'])) 
	{ 
		$_SESSION['productid']=$_POST['productid'];
	}
	
	if(isset($_SESSION['loggedIn'])) 
	{
		include 'wishlist.php';
		unset($_SESSION['productid']);
	}
	else
	{
		include 'loginform.php';		
	}
	exit();
}
if(isset($_POST['removefromcart']))
{
	$itemid=$_POST['productid'];
	session_start();
	unset($_SESSION['items'][$itemid]) ;
	unset($_SESSION['productid']);
	include 'shoppingcart.php';
	exit();
}
if(isset($_POST['addtocart']))
{
	session_start();
	if (!isset($_SESSION['cart']))
	{
		$_SESSION['cart'] = TRUE;
	}
	if (isset($_POST['productid'])) 
	{ 
		$productid=$_POST['productid'];
		$productname=$_POST['productname'];
		$productimageurl=$_POST['productimageurl'];
		$productprice=$_POST['productprice'];
		$productdescription=$_POST['productdescription'];
		$quantity=removeUnwanted($_POST['quantity']);
		$quantityinsmall=removeUnwanted($_POST['quantityinsmall']);
		$quantityinmedium=removeUnwanted($_POST['quantityinmedium']);
		$quantityinlarge=removeUnwanted($_POST['quantityinlarge']);
		$quantityinextralarge=removeUnwanted($_POST['quantityinextralarge']);
		if ($_POST['size']=="select") {
			$sizeerror="Please select a size.";
			if (isset($_SESSION['cart'])) {
				unset($_SESSION['cart']);
			}
			include 'productdescription.php';
			exit();
		}
		if ($quantity<1 || empty($quantity)) {
			$quantityerror="Please enter a quantity.";
			if (isset($_SESSION['cart'])) {
				unset($_SESSION['cart']);
			}
			include 'productdescription.php';
			exit();
		}
		if ($_POST['size']=="small") {
			if($quantity>$quantityinsmall)
			{
				$quantityerror="Sorry, We only have $quantityinsmall in stock in small size.";
				if (isset($_SESSION['cart'])) {
				unset($_SESSION['cart']);
				}
				include 'productdescription.php';
				exit();
			}
		}
		if ($_POST['size']=="medium") {
			if($quantity>$quantityinmedium)
			{
				$quantityerror="Sorry, We only have $quantityinmedium in stock in medium size.";
				if (isset($_SESSION['cart'])) {
				unset($_SESSION['cart']);
				}
				include 'productdescription.php';
				exit();
			}
		}
		if ($_POST['size']=="large") {
			if($quantity>$quantityinlarge)
			{
				$quantityerror="Sorry, We only have $quantityinlarge in stock in large size.";
				if (isset($_SESSION['cart'])) {
				unset($_SESSION['cart']);
				}
				include 'productdescription.php';
				exit();
			}
		}
		if ($_POST['size']=="extralarge") {
			if($quantity>$quantityinextralarge)
			{
				$quantityerror="Sorry, We only have $quantityinextralarge in stock in extralarge size.";
				if (isset($_SESSION['cart'])) {
				unset($_SESSION['cart']);
				}
				include 'productdescription.php';
				exit();
			}
		}
		$_SESSION['productid']=$_POST['productid'];
		$_SESSION['productname']=$_POST['productname'];
		$_SESSION['productimageurl']=$_POST['productimageurl'];
		$_SESSION['productprice']=$_POST['productprice'];
		$_SESSION['size']=$_POST['size'];
		$_SESSION['quantity']=$_POST['quantity'];
		$_SESSION['productdescription']=$_POST['productdescription'];
	}
	//check if logged in
	if(isset($_SESSION['loggedIn'])) 
	{
		include 'shoppingcart.php';
		unset($_SESSION['productid']);
	}
	else
	{
		include 'loginform.php';
	}
	exit();
}
if(isset($_POST['logoutform']))
{
	include 'logout.php';
	
}
if(isset($_POST['loginform']))
{
	include 'loginform.php';
	exit();
}
if(isset($_POST['login']))
{
	include 'loginverification.php';
	
}
if(isset($_POST['signupform']))
{
	include 'signupform.php';
	exit();
}
if(isset($_POST['signup']))
{
	include 'signupverification.php';
	
}
if(isset($_POST['product']))
{
	$productid=$_POST['productid'];
	$productname=$_POST['productname'];
	$productimageurl=$_POST['productimageurl'];
	$productprice=$_POST['productprice'];

	include 'productdescription.php';
	exit();
}
if(isset($_POST['subcategory']))
{
	$maincategoryid= $_POST['maincategoryid'];
	$subcategoryid=$_POST['subcategoryid'];	
	$subcategoryname=$_POST['subcategoryname'];
	include 'product.php';
	exit();
}
if(isset($_POST['maincategory']))
{
	$maincategoryid= $_POST['maincategoryid'];
	$maincategoryname= $_POST['maincategoryname'];
	
	include 'subcategory.php';
	exit();
}

include "home.php";
