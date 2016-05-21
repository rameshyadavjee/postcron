<?php require_once('includes/config.php');
	//session_start();
	if(isset($_SESSION['userid']) && $_SESSION['userid']!='') {
		header("Location:dashboard.php");exit();
	}
	
	$_SESSION['log_errormsg'] = '';
	if(isset($_POST['submit'])&& $_POST['submit']=='Submit')
	{
		unset($_SESSION['log_errormsg']);
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		
		$_SESSION['username'] = trim($_POST['username']);
		
		if($username =="") {
			$_SESSION['log_errormsg']="Username should not be blank.";
		}
		
		if($password=="")
		{
			if($_SESSION['log_errormsg'] !='') {		
				$_SESSION['log_errormsg'] .= "<br>Password should not be blank.";
			}
			else {
				$_SESSION['log_errormsg'] = "Password should not be blank.";
			}
		}
		
		if(!isset($_SESSION['log_errormsg']) || $_SESSION['log_errormsg']=='')
		{
			$usersql="select * from user where username = '".$username."' and password = '".$password."' limit 0,1 ";
			$userresult = mysqli_query($db1,$usersql);
			
			if(!$userresult) {
				$message = "Invalid query".mysql_error()."\n";				
			}
			else
			{
				$row = mysqli_fetch_array($userresult);
				$cnt = mysqli_num_rows($userresult);
				
				if($cnt > 0)
				{
				$sql1 = "insert into loginview (user_id,username,logintime) values('".$row ['user_id']."','".$row ['username']."',now())";
				    mysqli_query($db1,$sql1) ;
					$_SESSION['userid'] = $row['user_id'];
					$_SESSION['mastername'] = $row['username']; 
					header("Location:dashboard.php");exit;
				}
				else
				{
					$_SESSION['log_errormsg'] = "Sorry! User or Password is incorrect";
					header("Location:login.php");exit;
				}
			}
		}
		else {
			header("Location:login.php");exit();
		}
	}
?>