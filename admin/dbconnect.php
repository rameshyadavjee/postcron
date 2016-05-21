<?php
	if($_SERVER['HTTP_HOST'] == 'localhost')
	{
		define("HOSTNAME","localhost");
		define("DB_USERNAME","root");
		define("DB_PASSWORD","");
		define("DB_NAME","postcron");
		
	}
	else if($_SERVER['HTTP_HOST'] == 'demofree.in' || $_SERVER['HTTP_HOST'] == 'www.demofree.in' )
	{
		define("HOSTNAME","localhost");
		define("DB_USERNAME","demofree_social");
		define("DB_PASSWORD","social");
		define("DB_NAME","demofree_social");
		
	}
	
	if($db1 = mysqli_connect(HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME))
	{
		if(!mysqli_select_db($db1,DB_NAME)) {
			echo 'Erorr in selecting database'; exit();
		}
	}
	else {
		echo 'Erorr in database connection string'; exit();
	}
include_once("dbclass.php");
?>