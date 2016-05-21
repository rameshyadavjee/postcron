<?php include('dbconnect.php'); ?>
<?php include("header.php");include("leftmenu.php"); ?>

<form id="formID" name="registration" method="post" action="registred.php" >
  <table width="395" border="5" align="center">
    <tr>
      <td colspan="2">&nbsp;<?php if(isset($_SESSION['reg_errormsg']) && $_SESSION['reg_errormsg']!="") {echo $_SESSION['reg_errormsg'];unset($_SESSION['reg_errormsg']); } ?></td>
    </tr>
    <tr>
      <td width="131" >Username</td>
      <td width="248"><input type="text" name="username" id="username" value="<?php if(isset($_SESSION['username']) && $_SESSION['username']!="") {echo $_SESSION['username'];unset($_SESSION['username']); } ?>"/></td>
    </tr>
    <tr>
      <td width="131">UserPassword</td>
      <td width="248"><input type="password" name="password" id="password"  value="<?php if(isset($_SESSION['password']) && $_SESSION['password']!="") {echo $_SESSION['password'];unset($_SESSION['password']); } ?>" /></td>
    </tr>
    <tr>
      <td width="131" >FirstName</td>
      <td width="248"><input type="text" name="firstname" id="firstname" value="<?php if(isset($_SESSION['firstname']) && $_SESSION['firstname']!="") {echo $_SESSION['firstname'];unset($_SESSION['firstname']); } ?>" /></td>
    </tr>
    <tr>
      <td width="131" >LastName</td>
      <td width="248"><input type="text" name="lastname" id="lastname"  value="<?php if(isset($_SESSION['lastname']) && $_SESSION['lastname']!="") {echo $_SESSION['lastname'];unset($_SESSION['lastname']); } ?>"/></td>
    </tr>
    <tr>
    <tr> </tr>
    
      <td width="131" >Email</td>
      <td width="248"><input type="text" name="email" id="email"   value="<?php if(isset($_SESSION['email']) && $_SESSION['email']!="") {echo $_SESSION['email'];unset($_SESSION['email']); } ?>"/></td>
    </tr><tr>
      <td width="131" >UserStatus</td>
      <td width="248">
      <select name="status" id="status">
      <option value="">Select Status</option>
      <option value="1">Enable</option>
      <option value="0">Disable</option>     
	  </select>
    </td>
    </tr>
    <tr> </tr>
    <tr>
      <td colspan="2"><label>
          <input type="submit" name="submit" id="submit" value="Submit" />
        </label></td>
    </tr>
  </table>
</form>
<?php include('footer.php');?>