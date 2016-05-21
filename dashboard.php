<?php include("header.php"); include("validate.php");?>
<!-- Page Title -->

<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="span12"> <i class="icon-envelope-alt page-title-icon"></i>
        <h2>Dashboard </h2>
        <p>Here is your dashbord</p>
      </div>
    </div>
  </div>
</div>
<!-- Page Dashbord -->
<div class="what-we-do container">
  <div class="row">
    <div class="service span4">
      <div class="icon-awesome"> <i class="icon-eye-open"></i> </div>
      <h4>Click for settings</h4>     
        <?php 
		$sql="select * from socialnetwork where status = 1";
		$result = mysqli_query($db1,$sql);		
		if(!$result) {$message = "Invalid query"."\n";}						
	    $cnt = mysqli_num_rows($result);		
		
		if($cnt>0){
		while($row = mysqli_fetch_array($result)){ ?>
          <a href="<?php echo $row['social_link'];?>" style="color:#FFFFFF;">&nbsp;<?php echo $row['social_name'];?></a>
        <?php } 		
		} else { echo "Record not found"; }  ?>

    </div>    
    
    <div class="service span8">
      <div class="icon-awesome"><i class="icon-table"></i> </div>
      <form id="" name="" action="post_message.php" method="post" enctype="multipart/form-data">
        <div style="float:left;text-align:left">
          <script>	
	  		checked = false;
			function ToggleAll(source) {
			checkboxes = document.getElementsByName('socials[]');
			for(var i=0, n=checkboxes.length;i<n;i++) {
			checkboxes[i].checked = source.checked;
			}
		   }
		  </script>
          <style>
	  input[type='checkbox'] { margin: 5px; }
	  </style>
          <?php 
	  //oauth_provider'] == 'facebook
	  
	  $userid = $_SESSION['userid'];
	$UserDetail_SQL = "SELECT * FROM `users_social` WHERE `user_id` = '$userid'";
	$facebook = 0;	
	
	$result = mysqli_query($db1,$UserDetail_SQL);
	if(mysqli_num_rows($result)>0)
	{	
	echo '<p style="padding-bottom: 0px;line-height: 0px;margin-bottom: 2px;">
	<input type="checkbox" name="socialsall[]" value="'.$usrarr['oauth_provider'].'" id="socialsall" onclick="ToggleAll(this);">Select All ';echo ucfirst($usrarr['oauth_provider']).'</p>';
		while($usrarr = mysqli_fetch_array($result))
		{
			//if($usrarr['oauth_provider'] == 'facebook') {
				echo '<p style="padding-bottom: 0px;line-height: 0px;margin-bottom: 2px;"><input type="checkbox" name="socials[]" value="'.$usrarr['oauth_provider'].'" > ';echo ucfirst($usrarr['oauth_provider']).'</p>';//$facebook = 1;
				
			//}			
		}
	}
	  ?>
        </div>
        <textarea id="txt_message" name="txt_message"></textarea>
        <input type="submit" value="Post" name="btn_submit" id="btn_submit" class="submit">
      </form>
    </div>    
    <!--   row close here  -->
  </div>
</div>
<?php include("footer.php");?>
