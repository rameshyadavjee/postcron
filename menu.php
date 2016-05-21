<?php $pname= basename($_SERVER['PHP_SELF']); $pname=explode(".",$pname);?> 
<div class="nav-collapse collapse">
  <ul class="nav pull-right">
    <li <?php if($pname[0]=="index"){ echo "class=current-page";}?>> <a href="index.php"><i class="icon-home"></i><br />
      Home</a> </li>
    <li <?php if($pname[0]=="about"){ echo "class=current-page";}?>> <a href="about.php"><i class="icon-user"></i><br />
      About</a> </li>  
    <li <?php if($pname[0]=="contact"){ echo "class=current-page";}?>> <a href="contact.php"><i class="icon-envelope-alt"></i><br />
      Contact</a> </li>
  </ul>  
</div>
<div style="clear:right;"></div>
 <!-- Login start-->
    	<?php  if(!isset($_SESSION['userid'])|| $_SESSION['userid']=="") {?>	  
      	<div style="float:right;"><a href="register.php">Register</a>&nbsp;|&nbsp;<a href="login.php">Login</a></div>
	     <?php } else { ?>
         <div style="float:right;">Welcome  <?php echo ucfirst($_SESSION['mastername']);?>&nbsp;|&nbsp;<a href="dashboard.php">Dashboard</a>&nbsp;|&nbsp;<a href="logout.php">Logout</a><br>
</div>   <?php } ?>
         <!-- Login ends-->