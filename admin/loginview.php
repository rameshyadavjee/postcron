<?php include('dbconnect.php'); ?>
<?php include("header.php");include("leftmenu.php");?>
<div id="main-container" style="float:left;border:1px solid #000000; width:62%;">
	<div style="border:1px solid #000000;width:700px;float:none;overflow:hidden; padding: 0 0 10px 0;">&nbsp;
        <span style="width:220px;border:1px solid #000000;margin-left:10px;float:left;">User ID</span> 
        <span style="width:220px;border:1px solid #000000;margin-left:20px;float:left;">User Name</span> 
        <span style="width:200px;border:1px solid #000000;margin-left:10px;float:left;">Date Time</span> 
	</div>    

  <div id='content' style="border:1px solid #000000;width:700px;float:none;overflow:hidden;margin:10px 0 10px 0; padding: 0 0 10px 0;">

	<?php
    $sql1="select * from loginview"; $sql_row1=mysqli_query($db1,$sql1);?>
    
    <?php while($sql_res1=mysqli_fetch_assoc($sql_row1)){ ?>
     <p> 
    <span style="width:220px;border:1px solid #000000;margin-left:10px;float:left;"><?php echo $sql_res1["user_id"]; ?></span> 
    <span style="width:220px;border:1px solid #000000;margin-left:20px;float:left;"><?php echo $sql_res1["username"]; ?></span> 
    <span style="width:200px;border:1px solid #000000;margin-left:10px;float:left;"><?php echo $sql_res1["logintime"]; ?></span> 

    <?php }?>
	</p>    
</div>

</div>
<?php include("footer.php"); ?>