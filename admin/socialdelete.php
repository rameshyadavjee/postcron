<?php @session_start();
include("dbconnect.php");

$delid = trim($_REQUEST['id']);

$sql = "delete from socialnetwork where social_id = '".$delid."' ";
$result = mysqli_query($db1,$sql);

if (!$result) { $message  = 'Invalid query: ' . mysql_error() . "\n";  die($message); }

$aftrow = mysqli_affected_rows($db1);

if($aftrow>0){
	
	$_SESSION['social_errormsg'] = "Successfully Deleted"; 		
	header("location:socialnetwork.php");	exit;
	
} else {
	
	$_SESSION['social_errormsg'] = "Not Deleted"; 		
	header("location:socialnetwork.php");exit;
}

?>