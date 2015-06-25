$(document).ready(function()
{
	$("#menu").click(function()
	{
		$('#menulist').show();
	});
	$("#close").click(function()
	{
		$('#menulist').hide();
	});
	$("#searchicon").click(function()
	{
		$('#searchdetail').show();
	});
	$("#s_close").click(function()
	{
		$('#searchdetail').hide();
	});
	$("#btnloginsubmit").click(function(event)
	{
		email = document.getElementById('email').value;
		emailError=document.getElementById('emailError');
		validateEmail();
		password = document.getElementById('password').value;
		passwordError=document.getElementById('passwordError');
		validatePassword();
		if( validateEmail() && validatePassword())
		{
			$("#loginform").submit();
		}
		else
		{
			event.preventDefault();
		}
	});
	$("#btnsignupsubmit").click(function(event)
	{
		name = document.getElementById('fname').value;
		nameError=document.getElementById('nameError');
		validateName();
		name = document.getElementById('lname').value;
		nameError=document.getElementById('nameError');
		validateName();
		email = document.getElementById('email').value;
		emailError=document.getElementById('emailError');
		validateEmail();
		password = document.getElementById('password').value;
		passwordError=document.getElementById('passwordError');
		validatePassword();
		if(validateName() && validateEmail() && validatePassword())
		{
			$("#signupform").submit();
		}
		else
		{
			event.preventDefault();
		}
	});
	$("#sendbtn").click(function(event)
	{
		name = document.getElementById('name').value;
		nameError=document.getElementById('nameerror');
		validateName();
		email = document.getElementById('email').value;
		emailError=document.getElementById('emailerror');
		validateEmail();
		phone = document.getElementById('phone').value;
		phoneError=document.getElementById('phoneerror');
		validatePhone();
		message = document.getElementById('message').value;
		messageError=document.getElementById('messageerror');
		validateMessage();
		if(validateName() && validateEmail() && validatePhone() && validateMessage())
		{
			$("#contactform").submit();
		}
		else
		{
			event.preventDefault();
		}
	});
	$("#ad-editbtn").click(function(event)
	{
		ctgName=document.getElementById('ctg-name').value;
		description= document.getElementById('description').value;
		options = document.getElementsByName('editimage');
		adCtgError=document.getElementById('ad-ctg-error');
		if(validateProdName() && validateDescription() && validateRadiobtn())
		{
			$("#ad-categoryform").submit();
		}
		else
		{
			event.preventDefault();
		}
	});
	$("#ad-addbtn").click(function(event)
	{
		ctgName=document.getElementById('ctg-name').value;
		description= document.getElementById('description').value;		
		adCtgError=document.getElementById('ad-ctg-error');
		if(validateProdName() && validateDescription())
		{
			$("#ad-categoryform").submit();
		}
		else
		{
			event.preventDefault();
		}
	});	
	$("#addproductsubmit").click(function(event)
	{
		ctgName=document.getElementById('productname').value;
		description= document.getElementById('pro-description').value;
		productkeywords= document.getElementById('ad-pro-keywords').value;
		productPrice= document.getElementById('productprice').value;
		small= document.getElementById('small').value;
		medium= document.getElementById('medium').value;
		large= document.getElementById('large').value;
		extralarge= document.getElementById('extralarge').value;		
		adCtgError=document.getElementById('addproducterror');
		if(validateProdName() && validateDescription() && validateProKeywords() && validatePrice() && validateSize)
		{
			$("#ad-pdt-form").submit();
		}
		else
		{
			event.preventDefault();
		}
	});	
	$(".deleteproductbtn").click(function(event)
	{
		var deleteProductConfirm=confirm("Do you really want to delete this product?");
		if(deleteProductConfirm)
		{
			$("#pro-form").submit();
		}
		else
		{
			event.preventDefault();
		}
	});	
	$("#editproductsubmit").click(function(event)
	{
		ctgName=document.getElementById('productname').value;
		description= document.getElementById('pro-description').value;
		productkeywords= document.getElementById('ed-pro-keywords').value;
		productPrice= document.getElementById('productprice').value;
		options = document.getElementsByName('editimage');
		adCtgError=document.getElementById('editproducterror');
		if(validateProdName() && validateDescription() && validateProKeywords() && validatePrice() && validateRadiobtn())
		{
			$("#ed-pdt-form").submit();
		}
		else
		{
			event.preventDefault();
		}
	});
	$("#addtoshoppingcart").click(function(event)
	{
		quantity= document.getElementById('quantity').value;
		size = document.getElementsByName('size').value;
		proDesErr=document.getElementById('pro-des-error');
		if(validateProQuantity() && validateProSize)
		{
			$("#productdescriptionform").submit();
		}
		else
		{
			event.preventDefault();
		}
	});		
});

// Email validation
function validateEmail()
{	
	if(email.length==0)
	{
		emailError.innerHTML="Please enter an email";
		return false;
	}
	pos1=email.indexOf('@');
	pos2=email.indexOf('.');
	var betweenAtAndPeriod=email.substring(pos1+1,pos2);
	if(pos1>0 && pos2>2 && email.length!==0 && betweenAtAndPeriod.length!==0){
		emailError.innerHTML="";
		return true;
	}
	else{
		emailError.innerHTML="Please enter a valid Email";
		return false;
	}
}

// Password validation
function validatePassword()
{	
	if(password.length==0)
	{
		passwordError.innerHTML="Please enter a Password";
		return false;
	}
	if (password.length>20)
	{
		passwordError.innerHTML="Your password is too long. Please try again.";
		return false;
	}
	else
	{
		passwordError.innerHTML="";
		return true;
	}
}
// Name validation
function validateName()
{	
	if(name.length==0 )
	{
		nameError.innerHTML="Please enter a name";
		return false;
	}
	if (name.length>40) 
	{
		nameError.innerHTML="Your Name is too long. Please try again with a short name.";
		return false;
	}
	else
	{
		nameError.innerHTML="";
		return true;
	}
}
// phone validation
function validatePhone()
{
	
	if(phone.length==0 )
	{
		phoneError.innerHTML="Please enter a phone number";
		return false;
	}
	if (phone.length>15) 
	{
		phoneError.innerHTML="The entered phone number is too long. Please try again.";
		return false;
	}
	var regExpPh1=/^02[0,1,7,8,9][0-9]{6,8}$/;
	var regExpPh2=/^[0-9]{7}$/;
	var regExpPh3=/^0(3|4|6|7|9)[0-9]{7}$/;
	if (phone.match(regExpPh1)||phone.match(regExpPh2)||phone.match(regExpPh3)) {
		phoneError.innerHTML="";
		return true;
	}
	else
	{
		phoneError.innerHTML="Invalid phone number. Please try again.";
		return false;
	}
}
//message validation
function validateMessage()
{	
	if(message.length==0 )
	{
		messageError.innerHTML="Please write a message.";
		return false;
	}
	if (message.length>500) 
	{
		messageError.innerHTML="Your message is too long. Please try to make it short.";
		return false;
	}
	else
	{
		messageError.innerHTML="";
		return true;
	}
}
//product name validation
function validateProdName()
{
	if(ctgName.length==0 )
	{
		adCtgError.innerHTML+="<br>Please enter a category name";
		return false;
	}
	if (ctgName.length>60) 
	{
		adCtgError.innerHTML+="<br>The entered category name is too long. Please try again with a short name.";
		return false;
	}
	else
	{
		return true;
	}
}
//description validation
function validateDescription()
{
	if(description.length==0 )
	{
		adCtgError.innerHTML+="<br>Please write a description.";
		return false;
	}
	if (description.length>500) 
	{
		adCtgError.innerHTML+="<br>Your description is too long. Please try to make it short.";
		return false;
	}
	else
	{		
		return true;
	}
}
// radio btn validation
function validateRadiobtn()
{
	var optionChecked = false;
	for(var i=0;i<options.length;i++)
	{
		if(options[i].checked)
		{
			optionChecked = true;
		}
	}
	if (optionChecked)
	{
		return true;		
	}
	else
	{
		adCtgError.innerHTML +="<br>Please check an option";
		return false;		
	}
}
//product price validation
function validatePrice()
{
	if (productPrice<1)
	{
		adCtgError.innerHTML+="<br>Price must be greater than $1. Please try again.";
		return false;
	}
	else
	{
		return true;
	}
}
//size validation
function validateSize()
{
	if (small>=0 && medium>=0 && large>=0 && extralarge>=0) 
	{
		if (small==0 && medium == 0 && large ==0 && extralarge==0) 
		{
			adCtgError.innerHTML+="<br>A product with no stock cannot be added. Please try again.";
			return false;
		}
		else
		{
			return true;
		}
	}
	else
	{
		adCtgError.innerHTML+="<br> Please enter the number of items available in each size.";
		return false;
	}
}
//
function validateProQuantity()
{
	if(quantity.length==0)
	{
		proDesErr.innerHTML="Please enter the quantity.";
		return false;
	}
	else
	{
		if(quantity>0 && quantity<100)
		{
			return true;
		}
		else
		{
			proDesErr.innerHTML+="<br>Please enter a quantity between 1 and 99.";
			return false;
		}

	}
}
//product size validation
function validateProSize()
{
	if (size == "select") 
	{
		proDesErr.innerHTML+="<br>Please select a size.";
		return false;
	}
	else
	{
		return true;
	}
}
//product keywords validation
function validateProKeywords()
{
	if (productkeywords.length==0 || productkeywords.length>200) 
	{
		adCtgError.innerHTML+="<br>The product keywords field is either too long or empty. Please try again.";
		return false;
	}
	else
	{
		return true;
	}
}