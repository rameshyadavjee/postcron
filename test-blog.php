<?php
session_start();
require_once 'app/blogger/Google_Client.php';
require_once 'app/blogger/contrib/Google_BloggerService.php';
$scriptUri = "http://demofree.in/test-blog.php";
$client = new Google_Client();
$client->setAccessType('offline'); // default: offline
$client->setApplicationName('simplgrid'); //name of the application
$client->setClientId('544254302461-4g15477skgnanmrlbap6u4blqg059k74.apps.googleusercontent.com'); //insert your client id
$client->setClientSecret('esvw66x8EgLPfrL2cEvSHdZu'); //insert your client secret
$client->setRedirectUri($scriptUri); //redirects to same url
$client->setDeveloperKey('544254302461-4g15477skgnanmrlbap6u4blqg059k74@developer.gserviceaccount.com'); // API key (at bottom of page)
$client->setScopes(array('https://www.googleapis.com/auth/blogger')); //since we are going to use blogger services
$blogger = new Google_BloggerService($client);
if (isset($_GET['logout'])) { unset($_SESSION['token']); die('Logged out.'); }
if (isset($_GET['code'])) { $client->authenticate(); $_SESSION['token'] = $client->getAccessToken(); }
if (isset($_SESSION['token'])) { $token = $_SESSION['token']; $client->setAccessToken($token); }
if (!$client->getAccessToken()) { $authUrl = $client->createAuthUrl(); header("Location: ".$authUrl); die; }
$token=json_decode($token);

$ch = curl_init();
// Disable SSL verification
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,"https://www.googleapis.com/blogger/v3/users/self/blogs");
$header = array();
$header[] = 'Content-length: 0';
$header[] = 'Content-type: application/json';
$header[] = 'Authorization: Bearer '.$token->access_token;
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$data=curl_exec($ch);
$data=json_decode($data);
if(is_array($data->items) && count($data->items) >1)
{
echo'more';
	//print_r( $data->items);
	foreach($data->items as $blogs)
	{
		echo" <br>".$blogs->name.' '.$blogs->id;
	}
}
else
{echo'only one';
print_r( $data->items);
}
curl_close($ch);
echo "*****************************";
/*
$id='3209646126242674165';
$mypost = new Google_Post(); $mypost->setTitle('This is a test 1 title'); $mypost->setContent('this is a test 2 content');
$data = $blogger->posts->insert($id, $mypost); //post id needs here - put your blogger blog id */
?>