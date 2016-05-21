<?php session_start();

echo $_SESSION['code']."<br>";
echo $_SESSION['access_token'];
echo $_SESSION['token_type']."<br>"; 
echo $_SESSION['blog_url']."<br>";
echo $_SESSION['scope']."<br>";


$options  = array (
  'http' =>
  array (
    'ignore_errors' => true,
    'header' =>
    array (
      0 => 'authorization: Bearer '.$_SESSION['access_token'],
    ),
  ),
);
$context  = stream_context_create( $options );
$response = file_get_contents('https://public-api.wordpress.com/rest/v1/me/?pretty=true',true,$context);
print_r($response);
?>
