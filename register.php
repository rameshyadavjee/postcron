<?php include("header.php");?>
        <!-- Page Title -->
        <div class="page-title">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <i class="icon-envelope-alt page-title-icon"></i>
                        <h2>Register </h2>
                        <p>Here you can Register </p>
                    </div>
                </div>
            </div>
        </div>

                                    
<div class="what-we-do container">
  <div class="row">
    <div class="service span4">
      <div class="icon-awesome"> <i class="icon-eye-open"></i></div>
      <h5>Register</h5>
      <div style="text-align:left;padding-left:10px;">	
       <form id="registration" name="registration" method="post" action="registercheck.php" style="color:#000000;">
                <?php if(isset($_SESSION['reg_errormsg']) && $_SESSION['reg_errormsg']!="") {echo $_SESSION['reg_errormsg'];unset($_SESSION['reg_errormsg']);}?><br><br>
                <label for="name" class="nameLabel">User Name :</label><input type="text" name="username" id="username" value="<?php if(isset($_SESSION['username']) && $_SESSION['username']!="") {echo $_SESSION['username'];unset($_SESSION['username']); } ?>" />
				<label for="name" class="nameLabel">Password :</label><input type="password" name="password" id="password" value="<?php if(isset($_SESSION['password']) && $_SESSION['password']!="") {echo $_SESSION['password'];unset($_SESSION['password']); } ?>" />
                <label for="name" class="nameLabel">Email :</label><input type="text" name="email" id="email" value="<?php if(isset($_SESSION['email']) && $_SESSION['email']!="") {echo $_SESSION['email'];unset($_SESSION['email']); } ?>" />
				<?php if($row['captcha']=="1") { ?>
			    <label for="name" class="nameLabel">Security Code :</label><input name="security_code" type="text" size="5"/><img src="CaptchaSecurityImages.php?width=100&height=40&characters=5" />
				<?php } ?>
				<input type="submit" name="submit" id="submit" value="Submit" class="submit"/>
                </form>
      </div>
	</div>
    <div class="service span8">
      <div class="icon-awesome"> <i class="icon-magic"></i> </div>
           <h4>1 Click Solution for your Social Media Posting </h4>
      <p>Now you can post to your social media in 1 click from here.....</p>
      <a href="about.php">Read more</a> </div>   
    
  </div>
</div>
<?php include("footer.php");?>