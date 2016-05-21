<?php ob_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>1 Click Social Media Posting</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<!-- CSS -->
<link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/postcron/assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/postcron/assets/prettyPhoto/css/prettyPhoto.css">
<link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/postcron/assets/css/flexslider.css">
<link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/postcron/assets/css/font-awesome.css">
<link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/postcron/assets/css/style.css">
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
<!-- Favicon and touch icons -->
<link rel="shortcut icon" href="assets/ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/postcron/assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/postcron/assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/postcron/assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/postcron/assets/ico/apple-touch-icon-57-precomposed.png">
</head>
<body>
<noscript>
<div class="global-site-notice noscript">
  <div class="notice-inner">
    <p> <strong>JavaScript seems to be disabled in your browser.</strong><br />
      You must have JavaScript enabled in your browser to utilize the functionality of this website. </p>
  </div>
</div>
</noscript>
<?php require_once('includes/config.php');?>
<?php  	$sql="select * from settings";
		$result = mysqli_query($db1,$sql);		
		if(!$result) {
			$message = "Invalid query".mysqli_error()."\n";			
		}				
		$row = mysqli_fetch_array($result);					
	    $cnt = mysqli_num_rows($result);		
		if($cnt>0){ 
		if($row['notice']=="1"){
		?> 
        <div id="global-site-notice" style="border:1px solid #000000;display:block;">
          <center>
            This is a demo site.
          </center>
        </div> <?php } } ?>