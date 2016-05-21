<?php require_once('includes/config.php'); 
	$_SESSION['reg_errormsg'] = '';
	if(isset($_POST['submit'])&& $_POST['submit']=='Submit')
	{
		unset($_SESSION['reg_errormsg']);
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$email = trim($_POST['email']);
		$security_code = trim($_POST['security_code']);
		
		$_SESSION['username'] = trim($_POST['username']);
		$_SESSION['password'] = trim($_POST['password']);
		$_SESSION['email'] = trim($_POST['email']);
		
		if($username =="") {
			$_SESSION['reg_errormsg']="Username should not be blank.";
		}
		
		if($password=="")
		{
			if($_SESSION['reg_errormsg'] !='') {		
				$_SESSION['reg_errormsg'] .= "<br>Password should not be blank.";
			}
			else {
				$_SESSION['reg_errormsg'] = "Password should not be blank.";
			}
		}
		
		if($email=="")
		{
			if($_SESSION['reg_errormsg'] !='') {		
				$_SESSION['reg_errormsg'] .= "<br>Email should not be blank.";
			}
			else {
				$_SESSION['reg_errormsg'] = "Email should not be blank.";
			}
		}
		
		if(!isset($_SESSION['security_code']) || $_SESSION['security_code'] == '' )
		{
			
		}
		elseif($security_code=="")
		{
			if($_SESSION['reg_errormsg'] !='') {		
				$_SESSION['reg_errormsg'] .= "<br>Security code should not be blank.";
			}
			else {
				$_SESSION['reg_errormsg'] = "Security code should not be blank.";
			}
		}
		elseif(isset($_SESSION['security_code']) && $_SESSION['security_code'] != $security_code)
		{
			if($_SESSION['reg_errormsg'] !='') {		
				$_SESSION['reg_errormsg'] .= '<br>Sorry, you have provided an invalid security code';
			}
			else {
				$_SESSION['reg_errormsg'] = 'Sorry, you have provided an invalid security code';
			}
		}
		
		if($_SESSION['reg_errormsg']=='')
		{
			$user_sql = "insert into user(username,password,email)values('".$username."','".$password."','".$email."')";
			mysqli_query($db1,$user_sql); 
			
			$_SESSION['reg_errormsg'] = "Registration successfully completed.";
			unset($_SESSION['username']);
			unset($_SESSION['password']);
			unset($_SESSION['email']);
			unset($_SESSION['security_code']);
			header("Location:register.php");exit();
		}
		else {
			header("Location:register.php");exit();
		}
	}
?>