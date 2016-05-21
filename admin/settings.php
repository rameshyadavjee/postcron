<?php include('dbconnect.php'); ?>
<?php include("header.php");
include("leftmenu.php"); 
$sql="select * from settings";
$result = mysqli_query($db1,$sql);		
		if(!$result) {
			$message = "Invalid query".mysqli_error()."\n";			
		}				
		$res = mysqli_fetch_array($result);					
	    $cnt = mysqli_num_rows($result);
?>
<div id="main-container" style="float:left;border:1px solid #000000; width:80%; ">  
  <div style="border:1px solid #000000;width:900px;padding: 0 0 10px 0;">&nbsp;
    <div align="center">
      <?php if(isset($_SESSION['sitemsg']) && $_SESSION['sitemsg']!="") {echo $_SESSION['sitemsg'];unset($_SESSION['sitemsg']); } ?>
     
    </div>
	<span style="width:220px;border:1px solid #000000;margin-left:10px;float:left;">Enable Notice</span> 
<form action="setting_insert.php" method="post" enctype="multipart/form-data">&nbsp;
<select name="notice" size="1" id="notice">
<option value="1" <?php if($res['notice']=="1") { echo "selected='selected'"; } ?>>Enable</option>
<option value="0" <?php if($res['notice']=="0") { echo "selected='selected'"; } ?>>Disable</option>
</select>
<div style="border:1px solid #000000;width:900px;float:none;overflow:hidden; padding: 0 0 10px 0;">&nbsp;
<span style="width:220px;border:1px solid #000000;margin-left:10px;float:left;">News</span> 

<input type="text" name="news" id="news" size="8" value="<?php echo $res['news'];?>"/></div>

<div style="border:1px solid #000000;width:900px;float:none;overflow:hidden; padding: 0 0 10px 0;">&nbsp;
<span style="width:220px;border:1px solid #000000;margin-left:10px;float:left;">Captcha</span> 
<input type="radio" name="captcha" id="captcha" value="1" <?php if($res['captcha']=="1") { echo "checked='checked'"; } ?>/>
Enable<input type="radio" name="captcha" id="captcha" value="0" <?php if($res['captcha']=="0") { echo "checked='checked'"; } ?>/>
Disable</div>

<div style="border:1px solid #000000;width:900px;float:none;overflow:hidden; padding: 0 0 10px 0;">&nbsp;
<span style="width:220px;border:1px solid #000000;margin-left:10px;float:left;">Logo</span> 
<span style="float:left"><input type="file" name="file" id="file"/></span>&nbsp;&nbsp;<span><img src="<?php echo $res['logo'];?>" height="80" width="80"/></span></div>

<div style="border:1px solid #000000;width:900px;float:none;overflow:hidden; padding: 0 0 10px 0;">&nbsp;
<span style="width:220px;border:1px solid #000000;margin-left:10px;float:left;">Google analytics</span> 
<textarea cols="30" id="googleanalitic" name="googleanalitic"><?php echo $res['googleanalitic']?></textarea></div>
&nbsp;<input type="submit" name="submit" id="submit" value="Submit" /></form>
</div>
</div>
<?php include('footer.php');?>