<?php include('dbconnect.php'); ?>
<?php include("header.php");include("leftmenu.php"); ?>

<div id="main-container" style="float:left;border:1px solid #000000; width:80%;">
  <div style="float:left; margin-left:5px;"><a href="social.php">Add Social Network</a></div>
  <br />
  <br />
  <div style="border:1px solid #000099;width:700px;float:none;overflow:hidden; padding: 0 0 10px 0;">&nbsp;
    <div align="center">
      <?php if(isset($_SESSION['social_errormsg']) && $_SESSION['social_errormsg']!="") {echo $_SESSION['social_errormsg'];unset($_SESSION['social_errormsg']); } ?>
    </div>
    <span style="width:220px;border:1px solid #000000;margin-left:10px;float:left;">Social Name</span> 
    <span style="width:220px;border:1px solid #000000;margin-left:10px;float:left;">Social Link</span> 
    <span style="width:50px;border:1px solid #000000;margin-right:10px;float:right;">Delete</span> <span style="width:50px;border:1px solid #000000;margin-right:10px;float:right;">Edit</span> <span style="width:50px;border:1px solid #000000;margin-right:10px;float:right;">Status</span> </div>
  <div id='content' style="border:1px solid #000000;width:700px;float:left;margin:10px 0 10px 0; padding: 0 0 10px 0;">
    <?php
	$sql="select * from socialnetwork";
	$result = mysqli_query($db1,$sql);

    if(!$result) { $_SESSION['social_errormsg']='Invalid Query' . mysqli_error();}
    $numrow = mysqli_num_rows($result); 
	if($numrow > 0) { 
	while($row = mysqli_fetch_array($result)){ ?>
   
    <span style="width:220px;border:1px solid #000000;margin-left:10px;float:left;"> 
	<?php echo $row["social_name"]; ?></span> 
    <span style="width:220px;border:1px solid #000000;margin-left:10px;float:left;"> 
	<?php echo $row["social_link"]; ?></span> 
    <span style="width:50px;border:1px solid #000000;margin-right:10px;float:right;"> <a href="socialdelete.php?id=<?php echo $row['social_id'];?>">Delete</a></span> <span style="width:50px;border:1px solid #000000;margin-right:10px;float:right;"> <a href="socialedit.php?id=<?php echo $row['social_id'];?>">Edit</a></span> <span style="width:50px;border:1px solid #000000;margin-right:10px;float:right;">
    <?php if($row["status"]=="0"){echo "Disable"; } else { echo "Enable"; } ?>
    </span>
   
    <?php } // while 
   } // if of line 27
	  else {
           $_SESSION['cou_errormsg']= "No Record Founds"; exit;
	  } ?>
  </div>
</div>
<?php include('footer.php');?>
