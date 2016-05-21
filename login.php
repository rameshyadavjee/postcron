<?php include("header.php");?>
        <!-- Page Title -->
        <div class="page-title">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <i class="icon-envelope-alt page-title-icon"></i>
                        <h2>Login </h2>
                        <p>Here you can Login </p>
                    </div>
                </div>
            </div>
        </div>

                                    
<div class="what-we-do container">
  <div class="row">
    <div class="service span4">
      <div class="icon-awesome"> <i class="icon-eye-open"></i></div>
      <h5>Login</h5>
      <div style="text-align:left;padding-left:8px;">	
        <form method="post" name="login" id="login" action="logincheck.php">
        <?php if(isset($_SESSION['log_errormsg']) && $_SESSION['log_errormsg']!="") {echo $_SESSION['log_errormsg'];unset($_SESSION['log_errormsg']);}?><br><br>
        <label for="name" class="nameLabel">User Name :</label><input type="text" name="username" id="username" value="" />
        <label for="name" class="nameLabel">Password :</label><input type="password" name="password" id="password" value="" />
        <input type="submit" name="submit" id="submit" value="Submit" class="submit">
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