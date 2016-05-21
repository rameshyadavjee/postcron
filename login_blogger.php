<?php require_once('includes/config.php');
	
	
	require_once 'app/google/src/Google_Client.php';
	require_once 'app/google/src/contrib/Google_BloggerService.php';
	
	$userid = $_SESSION['userid'];
	$UserDetail_SQL = "SELECT * FROM `users_social` WHERE `user_id` = '$userid'";
	$facebook = 0;	
	
	if(isset($_POST['btn_blogger']))
	{
	$_SESSION['blogger_blogid']=$_POST['blogger_id'];
	}
	
	$result = mysql_query($UserDetail_SQL);
	if(mysql_num_rows($result)>0)
	{
		while($usrarr = mysql_fetch_array($result))
		{
			if($usrarr['oauth_provider'] == 'blogger') {
				$blogger = 1;
			}			
		}
	}
	
	if($blogger==0)
	{/*if (!isset($_SESSION['blogger_blogid'])) { // extract token from session and configure client
			
			exit;
		}*/
		$scriptUri = "http://".$_SERVER["HTTP_HOST"].$_SERVER['PHP_SELF'];
		$client = new Google_Client();
		$client->setAccessType('offline'); // default: offline
		$client->setApplicationName('simplgrid'); //name of the application
		$client->setClientId('544254302461-4g15477skgnanmrlbap6u4blqg059k74.apps.googleusercontent.com'); //insert your client id
		$client->setClientSecret('esvw66x8EgLPfrL2cEvSHdZu'); //insert your client secret
		$client->setRedirectUri($scriptUri); //redirects to same url
		$client->setDeveloperKey('544254302461-4g15477skgnanmrlbap6u4blqg059k74@developer.gserviceaccount.com'); // API key (at bottom of page)
		$client->setScopes(array('https://www.googleapis.com/auth/blogger')); //since we are going to use blogger services
		
		$blogger = new Google_BloggerService($client);
		
		if (isset($_GET['logout'])) { // logout: destroy token
			unset($_SESSION['token']);
		 die('Logged out.');
		}
		
		if (isset($_GET['code'])) { // we received the positive auth callback, get the token and store it in session
			$client->authenticate();
			 $arr= json_decode($client->getAccessToken());
			 $_SESSION['token'] =$client->getAccessToken();
			 $_SESSION['blogger_access_token'] =$arr->access_token;
		}
		if (!$client->getAccessToken()) { // auth call to google
		$authUrl = $client->createAuthUrl();
		header("Location: ".$authUrl);
		die;
		}
		if (isset($_SESSION['token'])) { // extract token from session and configure client
			//$_SESSION['blogger_blogid']='3209646126242674165';
			$token = $_SESSION['token'];
			$client->setAccessToken($token);
		}
		
		
			$ch = curl_init();
			// Disable SSL verification
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			// Will return the response, if false it print the response
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL,"https://www.googleapis.com/blogger/v3/users/self/blogs");
			$header = array();
			$header[] = 'Content-length: 0';
			$header[] = 'Content-type: application/json';
			$header[] = 'Authorization: Bearer '.$_SESSION['blogger_access_token'];
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			$data=curl_exec($ch);
			
			$data=json_decode($data);
			if(is_array($data->items) && count($data->items) >1)
			{
			//echo'More than on blogs';
				$i=0;
				foreach($data->items as $blogs)
				{
					//echo" <br>".$blogs->name.' '.$blogs->id;
					if($i==0)
					{
					$_SESSION['blogger_blogid']=$blogs->id;
					}
					$i++;
				}
			}
			elseif(is_array($data->items) && count($data->items) ==1)
			{
			//echo'Only One blog';
				$i=0;
				foreach($data->items as $blogs)
				{
					//echo" <br>".$blogs->name.' '.$blogs->id;
					if($i==0)
					{
					$_SESSION['blogger_blogid']=$blogs->id;
					}
					$i++;
				}
			//print_r( $data->items);
			//exit;
			}
			else
			{
			//echo'No blogs';
			$_SESSION['session_message']='No blogs available on blogger.Please create one blog.';
			header('Location:dashboard.php?msg=fail');
			exit();
			}
			curl_close($ch);
			//exit;
		
		
		$userdata = CheckUser($_SESSION['userid'], 'blogger','', '');
		
		
		header('Location:dashboard.php');
			exit();
	}
	else
	{
		header('Location:dashboard.php');
		exit();
	}
?>