<?php include('dbconnect.php'); ?>
<?php include("header.php");include("leftmenu.php"); 
if(isset($_REQUEST['id'])){
$editid = trim($_REQUEST['id']);
}else{
	$editid = '';
}
$query = "select * from socialnetwork where social_id = '".$editid."' limit 0,1";
$result = mysqli_query($db1,$query);
$row = mysqli_fetch_assoc($result);
?>
<form action="socialeditrecord.php" method="post" name="frm" id="frm">
<div id="main-container" style="float:left;border:1px solid #000000; width:80%;">
  <div style="border:1px solid #000000;float:none;overflow:hidden; padding: 0 0 10px 0;">&nbsp;
   <div align="center"><?php if(isset($_SESSION['social_errormsg']) && $_SESSION['social_errormsg']!="") {echo $_SESSION['social_errormsg'];unset($_SESSION['social_errormsg']); } ?></div>
  
   <div><span style="width:220px;border:1px solid #000000;margin-left:10px;float:left;">Social Name</span></div>
   <div> <span><input type="text" name="socialname" id="socialname" value="<?php echo $row['social_name'];?>"></span></div>
  
   <div><span style="width:220px;border:1px solid #000000;margin-left:10px;float:left;">Social Link</span></div>
   <div> <span><input type="text" name="sociallink" id="sociallink" value="<?php echo $row['social_link'];?>"></span></div>
    
    <div> <span style="width:220px;border:1px solid #000000;margin-left:10px;float:left;">Status</span>
    <span> <select name="status" id="status">
    <option value="1" <?php if($row['status']==1) {echo "selected='selected'"; }?>>Enable</option>
    <option value="0" <?php if($row['status']==0) {echo "selected='selected'"; }?>>Disable</option>     
	</select>
   <br /></span></div><div><span style="margin-left:10px;">
	 <input type="hidden" name="editid" id="editid" value="<?php echo $editid; ?>">      
     <input type="submit" value="Edit" name="Edit">
	   </div>
<?php include('footer.php');?>