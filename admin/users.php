<?php include('dbconnect.php'); ?>
<?php include("header.php");include("leftmenu.php"); ?>
<div id="main-container" style="float:left;border:1px solid #000000; width:80%;">
  <div style="float:left; margin-left:5px;"><a href="registration.php">Add Users</a>&nbsp;&nbsp;<a href="userexport.php">Export</a></div>
  <br />
  <br />
  <div style="border:1px solid #000000;width:900px;float:none;overflow:hidden; padding: 0 0 10px 0;">&nbsp;   
<div align="center">
<?php if(isset($_SESSION['users_errormsg']) && $_SESSION['users_errormsg']!="") {echo $_SESSION['users_errormsg'];unset($_SESSION['users_errormsg']); } ?></div>
 
    <span style="width:220px;border:1px solid #000000;margin-left:10px;float:left;">UserName</span> 
    <span style="width:220px;border:1px solid #000000;margin-left:20px;float:left;">Password</span> 
    <span style="width:200px;border:1px solid #000000;margin-left:10px;float:left;">Email</span> 
    <span style="width:50px;border:1px solid #000000;margin-right:10px;float:right;">Delete</span> 
    <span style="width:50px;border:1px solid #000000;margin-right:10px;float:right;">Edit</span> 
    <span style="width:50px;border:1px solid #000000;margin-right:10px;float:right;">Status</span> 
    
    </div>
    
  <div id='content' style="border:1px solid #000000;width:900px;margin:10px 0 10px 0; padding: 0 0 10px 0;height:auto; overflow:hidden;">
    <?php
	$sql="select * from user";
	$result=mysqli_query($db1,$sql);

    if(!$result) { $_SESSION['users_errormsg']='Invalid Query' ;}
    $numrow = mysqli_num_rows($result); 
	if($numrow>0) { while($row=mysqli_fetch_array($result)){ 
	?>
   
   <span style="width:220px;border:1px solid #000000;margin-left:10px;float:left;"> 
   <?php echo $row["username"]; ?></span> <span style="width:220px;border:1px solid #000000;margin-left:20px;float:left;"><?php echo $row["password"]; ?></span> 
   <span style="width:200px;border:1px solid #000000;margin-left:10px;float:left;"><?php echo $row["email"]; ?></span> 
   <span style="width:50px;border:1px solid #000000;margin-right:10px;float:right;"><a href="userdelete.php?id=<?php echo $row['user_id'];?>">Delete</a></span> 
   <span style="width:50px;border:1px solid #000000;margin-right:10px;float:right;"><a href="useredit.php?id=<?php echo $row['user_id'];?>">Edit</a></span> 
   <span style="width:50px;border:1px solid #000000;margin-right:10px;float:right;"><?php if($row["status"]=="0"){echo "Disable"; } else { echo "Enable"; } ?></span>
  
      <?php } // while 
   } else { $_SESSION['users_errormsg']= "No Record Founds"; exit; } ?>
    
    
</div>
</div>
<?php include('footer.php');?>
