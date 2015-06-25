<?php
$uploadpath = 'img/';      // directory to store the uploaded files
$max_size = 100;          // maximum file size, in KiloBytes
$alwidth = 300;            // maximum allowed width, in pixels
$alheight = 300;           // maximum allowed height, in pixels
$allowtype = array('bmp', 'gif', 'jpg', 'jpe','jpeg', 'png');        // allowed extensions

if(isset($_FILES['fileup']) && strlen($_FILES['fileup']['name']) > 1) 
{
  $uploadpath = $uploadpath . basename( $_FILES['fileup']['name']);       // gets the file name
  $sepext = explode('.', strtolower($_FILES['fileup']['name']));
  $type = end($sepext);     // gets extension
  list($width, $height) = getimagesize($_FILES['fileup']['tmp_name']);     // gets image width and height
  $err = '';         // to store the errors

  // Checks if the file has allowed type, size, width and height (for images)
  if(!in_array($type, $allowtype)) $err .= 'The file: <b>'. $_FILES['fileup']['name']. '</b> not has the allowed extension type.';
  if($_FILES['fileup']['size'] > $max_size*1000) $err .= '<br/>Maximum file size must be: '. $max_size. ' KB.';
  if(isset($width) && isset($height) && ($width > $alwidth || $height > $alheight)) $err .= '<br/>The maximum Width x Height must be: '. $alwidth. ' x '. $alheight;
  //check if the file already exists
  if (file_exists($uploadpath)) {
      $err .='<br>Sorry, file already exists';
  }
  // If no errors, upload the image, else, output the errors
  if($err == '') 
  {
    //search if an image already exist in the db with the same name, if not then upload.
    if(move_uploaded_file($_FILES['fileup']['tmp_name'], $uploadpath)) 
    { 
      session_start();
      
      if(isset($_SESSION['editmaincategory'])) {
        $_SESSION['maincategoryimageurl']=basename( $_FILES['fileup']['name']); 
        include 'inserteditedmaincategory.php';
      }    
      if(isset($_SESSION['addmaincategory'])) {
        $_SESSION['maincategoryimageurl']=basename( $_FILES['fileup']['name']); 
        include 'insertnewmaincategory.php';
      } 
      if (isset($_SESSION['editsubcategory'])) {
        $_SESSION['subcategoryimageurl']=basename( $_FILES['fileup']['name']); 
        include 'inserteditedsubcategory.php';
      }
      if (isset($_SESSION['addsubcategory'])) {
        $_SESSION['subcategoryimageurl']=basename( $_FILES['fileup']['name']); 
        include 'insertnewsubcategory.php';
      }
      if (isset($_SESSION['editproduct'])) {
        $_SESSION['productimageurl']=basename( $_FILES['fileup']['name']); 
        include 'inserteditedproduct.php';
      }
      if (isset($_SESSION['addproduct'])) {
        $_SESSION['productimageurl']=basename( $_FILES['fileup']['name']); 
        include 'insertnewproduct.php';
      }
      exit();           
    }
    else
    {
      $imageuploaderror= '<b>Unable to upload the file.</b>';
      include 'uploadimage.php';
      exit(); 
    } 
  }
  else 
  {
    $imageuploaderror= $err;
    include 'uploadimage.php';
    exit(); 
  }
}
else
{
  $imageuploaderror="Please upload an image";
  include 'uploadimage.php';
  exit(); 
}