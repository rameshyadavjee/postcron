<?php 
session_start();
error_reporting(0);
include("dbconnect.php");

if($_POST['button']=='Submit')
{
	$adminname = trim($_REQUEST['adminname']);
	$adminpassword = trim($_REQUEST['adminpassword']);
	$_SESSION['adminname'] = trim($_REQUEST['adminname']);
	$_SESSION['adminpassword'] = trim($_REQUEST['adminpassword']);

if($adminname=="")
	{
		$_SESSION['errormsg'] = "Username could not be blank";
		header("Location:index.php"); exit();
		
	}
	
if($adminpassword=="")
	{
		$_SESSION['errormsg'] = "Password could not be blank";
		header("Location:index.php"); exit();
	}


	    $sql="select * from admin where adminname = '".$adminname."' and adminpassword = '".$adminpassword."' limit 0,1 ";
		$result = mysqli_query($db1,$sql) ;
		
		if(!$result) {
			$message = "Invalid query".mysqli_error()."\n";
			die($message);			
		}
				
		$row = mysqli_fetch_array($result);			
		
	    $cnt = mysqli_num_rows($result); 
		
		if($cnt>0){			
			
			
			$_SESSION['mastername'] = $row ['adminname'];
			header("Location:dashboard.php");exit;
		} else {
			$_SESSION['errormsg'] = "Sorry! User or Password is incorrect"; 
			header("Location:index.php");exit;

		}		
				

} else {
	$_SESSION['errormsg'] = "There is some error. Please contact to Administartor";
	header("Location:index.php");exit;
	
}

?>