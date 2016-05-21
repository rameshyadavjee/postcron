<?php @session_start();
include("dbconnect.php");

if(isset($_POST['submit'])&& $_POST['submit']=='Submit')
{
	$socialname = trim($_REQUEST['socialname']);  
	$sociallink = trim($_REQUEST['sociallink']);    
    $status= trim($_REQUEST['status']);		     
	$_SESSION['socialname'] = trim($_REQUEST['socialname']);	
	$_SESSION['sociallink'] = trim($_REQUEST['sociallink']);	
	$_SESSION['status'] = trim($_REQUEST['status']);	
	if($socialname =="")
	{
		$_SESSION['social_errormsg']="Social name  should not be blank";
		header("Location:social.php");exit;
	}
	if($sociallink =="")
	{
		$_SESSION['social_errormsg']="Social Link should not be blank";
		header("Location:social.php");exit;
	}
	
	if($status=="")
	{
		$_SESSION['social_errormsg']="Status should not be blank";
		header("Location:social.php");exit;
	}
	
	$sql="insert into socialnetwork(social_name,social_link,status) values('".$socialname."','".$sociallink."','".$status."')"; 
	$result = mysqli_query($db1,$sql);
		
	if(!$result)
	{
		$_SESSION['social_errormsg']="Select proper query" . mysqli_error();
		header("Location:social.php");exit();
	}
	
	$aftrow = mysqli_affected_rows($db1);
	
	if($aftrow>0){
		$_SESSION['social_errormsg']="Sucessfully added";	
		header("Location:socialnetwork.php");exit;
	}	
	else {
		$_SESSION['social_errormsg']="Could not insert data into database";
		header("Location:socialnetwork.php");exit();
	}
		
} else{
		$_SESSION['social_errormsg']="There is some error in process. Please try again.";
		header("Location:socialnetwork.php");exit();
}
?>