<?php @session_start();
include("dbconnect.php");
$editid = trim($_REQUEST['editid']);
$socialname = trim($_REQUEST['socialname']);
$sociallink = trim($_REQUEST['sociallink']);
$status = trim($_REQUEST['status']);

if($socialname =="")
	{
		$_SESSION['social_errormsg']="Social name  should not be blank";
		header("Location:socialedit.php");exit;
	}
if($sociallink =="")
	{
		$_SESSION['social_errormsg']="Social Link  should not be blank";
		header("Location:socialedit.php");exit;
	}	
	
	if($status=="")
	{
		$_SESSION['social_errormsg']="Status should not be blank";
		header("Location:socialedit.php");exit;
	}



if(isset($_POST['Edit'])&& ($_POST['Edit']=='Edit')) {
$query = "update socialnetwork set social_name = '".$socialname."' ,social_link = '".$sociallink."' , status = '".$status."' where social_id = '".$editid."' "; 
$result=mysqli_query($db1,$query);

	
if (!$result) { $message  = 'Invalid query: ' . mysql_error() . "\n";  die($message); }
	
	$aftrow = mysqli_affected_rows($db1);
	
		if($aftrow>0){
			$_SESSION['social_errormsg'] = "Successfully
			Updated"; 		
			header("location:socialnetwork.php");
			exit;
		} else {		
			$_SESSION['social_errormsg'] = "Not Updated"; 		
			header("location:socialnetwork.php");
			exit;
		}
	
} else {
	 echo "could not check for Edit";
	 header("location:socialnetwork.php");
	 exit;
}	
?>