<?php require_once('includes/config.php'); 	
	if(isset($_SESSION['userid']) && $_SESSION['userid']!='')
	{
		session_destroy();
		header("Location:index.php");exit();
	}	
?>