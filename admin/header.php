<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Control Panel | Admin</title>
</head>
<body>
<div id="wrapper">
<noscript>
<div class="global-site-notice noscript">
  <div class="notice-inner">
    <p> <strong>JavaScript seems to be disabled in your browser.</strong><br />
      You must have JavaScript enabled in your browser to utilize the functionality of this website. </p>
  </div>
</div>
</noscript>
      
<div id="page">
<div id="header-container">
<div id="header" style="height:50px; border:1px solid #000000;">
  <div style="float:right;margin-right:10px;"><?php echo "Welcome &nbsp;&nbsp;" . ucfirst(isset($_SESSION['adminname']));?> |  &nbsp;<a href="logout.php">Logout</a></div>
  </div>
</div>