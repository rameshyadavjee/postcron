<?php @session_start();
	require_once('includes/config.php');
	require_once("app/twitter/codebird.php");
	require_once("app/twitter/twitteroauth.php");
	
	\Codebird\Codebird::setConsumerKey(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET); // I changed it to my   settings
	$cb = \Codebird\Codebird::getInstance();
	
	if (!isset($_SESSION['oauth_token']))
	{
		// get the request token
		$reply = $cb->oauth_requestToken(array('oauth_callback' => 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']));
		
		// store the token
		$cb->setToken($reply->oauth_token, $reply->oauth_token_secret);
		$_SESSION['oauth_token'] = $reply->oauth_token;
		$_SESSION['oauth_token_secret'] = $reply->oauth_token_secret;
		$_SESSION['oauth_verify'] = true;
		
		// redirect to auth website
		$auth_url = $cb->oauth_authorize();
		header('Location: ' . $auth_url);
		die();
	}
	elseif (isset($_GET['oauth_verifier']) && isset($_SESSION['oauth_verify']))
	{
		// verify the token
		$cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
		unset($_SESSION['oauth_verify']);
		
		// get the access token
		$reply = $cb->oauth_accessToken(array('oauth_verifier' => $_GET['oauth_verifier']));
		
		// store the token (which is different from the request token!)
		$_SESSION['oauth_token'] = $reply->oauth_token;
		$_SESSION['oauth_token_secret'] = $reply->oauth_token_secret;
		$_SESSION['oauth_verifier'] = $_GET['oauth_verifier'];
		
		// send to same URL, without oauth GET parameters
		header('Location: ' . basename(__FILE__));
		die();
	}
	else
	{
		$cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
		
		
		$twitteroauth = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
		$user_info = $twitteroauth->get('account/verify_credentials');
		
		$uid = $user_info->id;
        $username = $user_info->name;
		$userdata = CheckUser($_SESSION['userid'],'twitter',$uid,$username);
		
		if(!empty($userdata))
		{
			header('Location:dashboard.php?twitter=sucess');
			exit();
		}
		else {
			header('Location:dashboard.php?twitter=fail');
			exit();
		}
	}
?>