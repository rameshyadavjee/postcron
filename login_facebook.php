<?php require_once('includes/config.php');
	require_once('app/facebook/facebook.php');	
	
	$userid = $_SESSION['userid'];
	$UserDetail_SQL = "SELECT * FROM `users_social` WHERE `user_id` = '$userid'";
	$facebook = 0;	
	
	$result = mysqli_query($db1,$UserDetail_SQL);
	if(mysqli_num_rows($result)>0)
	{
		while($usrarr = mysql_fetch_array($result))
		{
			if($usrarr['oauth_provider'] == 'facebook') {
				$facebook = 1;
			}			
		}
	}
	
	if($facebook==0)
	{
		// Create our Application instance (replace this with your appId and secret).
		$config = array(
			'appId'  => FB_AppID,
			'secret' => FB_AppSecret,
  		);

		$facebook = new Facebook($config);
		$user_id = $facebook->getUser();
	
		if(!$user_id)
		{
			$login_url = $facebook->getLoginUrl( array( 'scope' => 'publish_stream,offline_access' ) );
			header('Location:'.$login_url);
			exit();
		}
		else
		{
			try {
				// Proceed knowing you have a logged in user who's authenticated.
				$user_profile = $facebook->api('/me');
				
				$username = $user_profile['username'];
				$userdata = CheckUser($_SESSION['userid'], 'facebook',$user_id, $username);
				
			}	
			catch (FacebookApiException $e) {
				error_log($e);
				$user = null;
			}
			header('Location:dashboard.php');
			exit();
		}
	}
	else
	{
		header('Location:dashboard.php');
		exit();
	}
?>