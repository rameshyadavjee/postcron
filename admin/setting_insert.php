<?php include('dbconnect.php'); ?>
<?php @session_start();
if($_FILES['file']['name'] != "") {
if (($_FILES["file"]["type"] == "image/jpeg") || 
($_FILES["file"]["type"] == "image/jpg") || 
($_FILES["file"]["type"] == "image/pipeg") || 
($_FILES["file"]["type"] == "image/gif") || 
($_FILES["file"]["type"] == "image/png")) {   

  if ($_FILES["file"]["error"] > 0) { 
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    } else { 
		  move_uploaded_file($_FILES["file"]["tmp_name"],"images/logo.png");  
		  //unlink($_REQUEST['image']);      
  	  } 
  } else {
	  $_SESSION['sitemsg']="<font color='red'>Invalid file.</font>";
	  header("location:" . $_SERVER['HTTP_REFERER']);	exit;
  }
//Image upload complete. 
}		

	   $sql1="update settings set 
	   notice = '".$_REQUEST["notice"]."',
	   news = '".$_REQUEST["news"]."', 	";  
	   if($_FILES['file']['name'] != "")
		{	
		 $sql1.="logo = 'images/logo.png',";
		}
		
		$sql1.="
	   captcha = '".$_REQUEST["captcha"]."',	   
	   googleanalitic = '".$_REQUEST["googleanalitic"]."' ";
		mysqli_query($db1,$sql1);			
		
		$_SESSION['sitemsg']="<font color='blue'>Site setting updated succesfully</font>";		
		header("location:settings.php"); exit;	
		
?>