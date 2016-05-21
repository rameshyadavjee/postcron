<?php
if(isset($_SESSION['userid']) && $_SESSION['userid']!='')
  {
  unset($_SESSION['reg_errormsg']);
  unset($_SESSION['log_errormsg']);
  unset($_SESSION['username']);
}
else 
{
 header("Location:login.php");exit(); 
}
?>