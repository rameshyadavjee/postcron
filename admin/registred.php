<?php
@session_start();
include("dbconnect.php");
if(isset($_POST['submit'])&& $_POST['submit']=='Submit')
{
	
     $username = trim($_REQUEST['username']);
     $password = trim($_REQUEST['password']);
	 $firstname= ucwords(trim($_REQUEST['firstname']));
     $lastname = ucwords(trim($_REQUEST['lastname']));
     $email = trim($_REQUEST['email']);
	 $status = trim($_REQUEST['status']);
	 
	$_SESSION['username'] = trim($_REQUEST['username']);
	$_SESSION['password'] = trim($_REQUEST['password']);
	$_SESSION['firstname'] = trim($_REQUEST['firstname']);
	$_SESSION['lastname'] = trim($_REQUEST['lastname']);
	$_SESSION['email'] = trim($_REQUEST['email']);
	$_SESSION['status'] = trim($_REQUEST['status']);
	
	
	
	
	if($username ==""){
		$_SESSION['reg_errormsg']="username  should not be blank";
		header("Location:registration.php");exit();
	}
	
	if($password==""){
		$_SESSION['reg_errormsg']="userpassword should not be blank";
		header("Location:registration.php");exit();
	}
	
	if($firstname==""){
		$_SESSION['reg_errormsg']="userfirstname should not be blank";
		header("Location:registration.php");exit();
	}
	
	if($lastname==""){
		$_SESSION['reg_errormsg']="userlastname should not be blank";
		header("Location:registration.php");exit();
	}
	if($email==""){
		$_SESSION['reg_errormsg']= "useremail should not be blank";
		header("Location:registration.php");exit();
			
	}
	if($status==""){
		$_SESSION['reg_errormsg']= "userstatus should not be blank";
		header("Location:registration.php");exit();
			
	}
	
	$sql="insert into user(username,password ,firstname,lastname,email,status)
	values('".$username."','".$password ."','".$firstname."','".$lastname."','".$email."','".$status."')";
	$query1=mysqli_query($db1,$sql);
	
	if(!$query1){
		$_SESSION['reg_errormsg']="select proper query".mysql_error();
		header("Location:registration.php");exit();
	}
	
	
	$aftrow = mysqli_affected_rows($db1);
	
	if($aftrow>0){
		$_SESSION['reg_errormsg']="Sucessfully added";	
		unset($_SESSION['username'],$_SESSION['password'],$_SESSION['firstname'],$_SESSION['lastname'],
		$_SESSION['email'],$_SESSION['status']);
		header("Location:registration.php");exit();
	}	
	else {
		$_SESSION['reg_errormsg']="Could not insert data into database";
		header("Location:registration.php");exit();
	}

	
}
else{
	$_SESSION['users_errormsg']="There is some error in process. Please try again.";
	header("Location:users.php");exit();
}
?>