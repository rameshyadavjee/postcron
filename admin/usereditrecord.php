<?php @session_start();
include("dbconnect.php");
$editid = trim($_REQUEST['editid']);
$username = trim($_REQUEST['username']);
$password = trim($_REQUEST['password']);
$firstname = trim($_REQUEST['firstname']);
$lastname = trim($_REQUEST['lastname']);
$email = trim($_REQUEST['email']);
$status = trim($_REQUEST['status']);

if($username =="")
	{
		$_SESSION['users_errormsg']="username should not be blank";
		header("Location:useredit.php?id=$editid");exit;
	}
	if($password=="")
	{
		$_SESSION['users_errormsg']="password should not be blank";
		header("Location:useredit.php");exit;
	}
	if($firstname=="")
	{
		$_SESSION['users_errormsg']="firstname should not be blank";
		header("Location:useredit.php");exit;
	}
	
	if($lastname =="")
	{
		$_SESSION['users_errormsg']="lastname should not be blank";
		header("Location:useredit.php");exit;
	}
	if($email=="")
	{
		$_SESSION['users_errormsg']="email should not be blank";
		header("Location:useredit.php");exit;
	}
	if($status=="")
	{
		$_SESSION['users_errormsg']="status should not be blank";
		header("Location:useredit.php");exit;
	}

if(isset($_POST['Edit'])&& ($_POST['Edit']=='Edit')) {

	$query = "update user set username = '".$username."' , password = '".$password."',firstname = '".$firstname."',lastname = '".$lastname."',email = '".$email."',status = '".$status."' where user_id = '".$editid."' ";
	$result = mysqli_query($db1,$query);
	
	
if (!$result) { $message  = 'Invalid query: ' . mysqli_error() . "\n";  }
	
		$aftrow = mysqli_affected_rows($db1); 
	
		if($aftrow>0){
			$_SESSION['users_errormsg'] = "Successfully Updated"; 		
			header("location:users.php");
			exit;
		} else {		
			$_SESSION['users_errormsg'] = "Not Updated"; 		
			header("location:users.php");
			exit;
		}
	
} else {
	 echo "could not check for Edit";
}	
?>