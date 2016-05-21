<?php @session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
</head><body>
<form action="logincheck.php" method="post" name="login" id="login">
<table width="407" border="1" align="center">
  <tr>
    <td colspan="3" align="center">&nbsp;<?php if(isset($_SESSION['errormsg']) && $_SESSION['errormsg']!="") {echo $_SESSION['errormsg'];unset($_SESSION['errormsg']); } ?></td>
  </tr>
  <tr>
    <td width="178">User Name</td>
    <td width="18">&nbsp;</td>
    <td width="189"><input type="text" name="adminname" id="adminname" value="<?php if(isset($_SESSION['adminname']) && $_SESSION['adminname']!="") {echo $_SESSION['adminname']; } ?>"></td>
  </tr>
  <tr>
    <td>Password</td>
    <td>&nbsp;</td>
    <td><input type="password" name="adminpassword" id="adminpassword" value="<?php if(isset($_SESSION['adminpassword']) && $_SESSION['adminpassword']!="") {echo $_SESSION['adminpassword']; } ?>"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="button" id="button" value="Submit"></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td><a href="forgotpassword.php">Forgot password</a></td>
  </tr>
</table>
</form>
</body>
</html>

