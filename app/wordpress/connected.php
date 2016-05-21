<?php 
session_start();
include_once('config.php');

if ( isset( $_GET[ 'code' ] ) ) {
  if ( false == isset( $_GET[ 'state' ] ) )
    die( 'Warning! State variable missing after authentication' );
  session_start();
  if ( $_GET[ 'state' ] != $_SESSION[ 'wpcc_state' ] )
    die( 'Warning! State mismatch. Authentication attempt may have been compromised.' );
 
  $curl = curl_init( REQUEST_TOKEN_URL );
  curl_setopt( $curl, CURLOPT_POST, true );
  curl_setopt( $curl, CURLOPT_POSTFIELDS, array(
    'client_id' => CLIENT_ID,
    'redirect_uri' => REDIRECT_URL,
    'client_secret' => CLIENT_SECRET,	
    'code' => $_GET[ 'code' ], // The code from the previous request
    'grant_type' => 'authorization_code'
  ) );
 
  curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1);
  $auth = curl_exec( $curl );
  $secret = json_decode( $auth );   
  $oauth_provider = 'wordpress';
  $_SESSION['code'] = $_GET['code']; 
  $_SESSION['access_token'] = $secret->access_token; 
  $_SESSION['token_type'] = $secret->token_type; 
  $_SESSION['blog_url'] = $secret->blog_url; 
  $_SESSION['scope'] = $secret->scope; 
  header("Location:post.php");exit;
}
?>