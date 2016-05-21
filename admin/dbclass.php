<?php   define("HOSTNAME1","localhost");
		define("DB_USERNAME1","root");
		define("DB_PASSWORD1","");
		define("DB_NAME1","postcron");
		
	if($db2 = mysqli_connect(HOSTNAME1,DB_USERNAME1,DB_PASSWORD1,DB_NAME1))
	{
		if(!mysqli_select_db($db2,DB_NAME1)) {
			echo 'Erorr in selecting database'; exit();
		}
	}
	else {
		echo 'Erorr in database connection string'; exit();
	}
		
		
		 ?>
<?php
function ExecuteGetRows($sql)
{
 $sqlquery=$sql;
 $executes=mysqli_query($db2,$sqlquery);
 $i=0;
 while(@$res=mysqli_fetch_array($executes,MYSQLI_NUM))
 {
   $result[$i]=$res;
   $i++;
 }
 return $result;
}
?>