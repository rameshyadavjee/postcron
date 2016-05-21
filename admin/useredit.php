<?php 
include('dbconnect.php'); ?>
<?php 
include("header.php");
include("leftmenu.php");

if(isset($_REQUEST['id']))
{
$editid = trim($_REQUEST['id']);
}
else
{
	$editid = '';
}
$query = "select * from user where user_id = '".$editid."' limit 0,1";
$result = mysqli_query($db1,$query);
$row = mysqli_fetch_assoc($result);
?>
<form name="editform" id="editform" method="post" action="usereditrecord.php">
<table width="200" border="5">

<tr>
<td colspan="2" align="center"><?php if(isset($_SESSION['users_errormsg']) && $_SESSION['users_errormsg']!="") {echo $_SESSION['users_errormsg'];unset($_SESSION['users_errormsg']); } ?></td>
</tr>

  <tr>
    <td>UserName</td>
    <td><input type="text" name="username" id="username" value="<?php echo $row['username'];?>"></td>
  </tr>
  <tr>
    <td> UserPassword</td>
    <td><input type="password" name="password" id="password" value="<?php echo $row['password'];?>"></td>
  </tr>
  <tr>
    <td>UserFirstname</td>
    <td><input type="text" name="firstname" id="firstname" value="<?php echo $row['firstname'];?>"></td>
  </tr>
  <tr>
    <td>UserLastname</td>
    <td><input type="text" name="lastname" id="lastname" value="<?php echo $row['lastname'];?>"></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><input type="text" name="email" id="email" value="<?php echo $row['email'];?>"></td>
  </tr>
  <tr>
    <td>UserStatus</td>
    <td>    
    <select name="status" id="status">
    <option value="1" <?php if($row['status']==1) {echo "selected='selected'"; }?>>Enable</option>
    <option value="0" <?php if($row['status']==0) {echo "selected='selected'"; }?>>Disable</option>     
	</select>
    </td>
  </tr>
  <tr>
    <td colspan="2"><input type="hidden" name="editid" id="editid" value="<?php echo $editid; ?>">      <input type="submit" value="Edit" name="Edit"></td>
  </tr>
</table>
</form>
<?php include('footer.php');?>