<?php @session_start();
include("dbconnect.php");

$delid = trim($_REQUEST['id']);

$query = "delete from user where user_id = '".$delid."' ";
$result = mysqli_query($db1,$query);

if (!$result) { $message  = 'Invalid query: ' . mysql_error() . "\n";  die($message); }

$aftrow = mysqli_affected_rows($db1);

if($aftrow>0){
	
	$_SESSION['users_errormsg'] = "Successfully Deleted"; 		
	header("location:users.php");
	exit;
	
} else {
	
	$_SESSION['users_errormsg'] = "Not Deleted"; 		
	header("location:users.php");
	exit;
}

?>