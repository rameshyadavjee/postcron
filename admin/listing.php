<?php include('dbconnect.php'); ?>
<?php include("header.php"); ini_set('display_errors','1');?>
<?php //include("leftmenu.php");?>
<style>
#content {width:500px;}
.pagination {list-style:none; margin:10px 0px 0px 0px; padding:0px; clear:both;}
.pagination li{float:left; margin:3px;}
.pagination li a{   display:block; padding:3px 5px; color:#fff; background-color:#44b0dd; text-decoration:none;}
.pagination li a.active {border:1px solid #000; color:#000; background-color:#fff;}
.pagination li a.inactive {background-color:#eee; color:#777; border:1px solid #ccc;}
</style>
<script src="js/jquery.js"></script>
<script src="js/jPaginate.js"></script>
<script>
$(document).ready(function(){
    $("#content").jPaginate();                       
});
</script>
<div id='content'>  
    <p> <?php
echo $sql="select news_id,news_title,short_description from news where status = '1'  order by news_id desc limit 0,3";
$result=mysql_query($sql);

  if(!$result) { 
    $_SESSION['news']='Invalid Query' . mysql_error(); exit;}
    $numrow = mysql_num_rows($result);
	
	if($numrow>0){
	   while($row=mysql_fetch_assoc($result)){ ?>
   
	<div><h2><?php echo $row["news_title"]; ?></h2></div>
    <div><?php echo substr($row["short_description"],0,100); ?>
    
    <a href="detail.php?id=<?php echo $row["news_id"]; ?>">more</a>
    </div>
  <?php } // while
  	 } // if line of 11
	  else {
           $_SESSION['news']= "No Record Founds"; exit;
	  } // if line of 7
?></p>  
    </div>
<?php include("footer.php");?>