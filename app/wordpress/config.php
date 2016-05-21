<?php @session_start();
	ini_set('display_errors','1');
	
	if($_SERVER['HTTP_HOST'] == 'www.demofree.in' || $_SERVER['HTTP_HOST'] == 'demofree.in')
	{
		define("HOSTNAME","localhost");
		define("DB_USERNAME","demofree_social");
		define("DB_PASSWORD","social");
		define("DB_NAME","demofree_social");
		
		// FOR FACEBOOK APPLICATION ID 
		define('FB_AppID','674819519215056');
		define('FB_AppSecret','966e99b03afd1247ecd1d5fa31d373bb');
		
		// FOR TWITTER APPLICATION ID
		define('TWITTER_CONSUMER_KEY', 'BtgrM2WLSjIrJ1utQvhNQ');
		define('TWITTER_CONSUMER_SECRET', 'J0PDOUy4xzpka5g9ICUv67qcFYug9SWs4YJkE93AI');
		
		define ( 'CLIENT_ID','33256'); //TODO
		define ( 'CLIENT_SECRET', '07DRPW2oH2NnfjMV6WBHnVbXydlP2RfFT2UFyIsaRGvHbBYlP9tm0TKnZhzgWr3b'); //TODO
		define ( 'LOGIN_URL', 'http://demofree.in/app/wordpress/index.php' ); //TODO
		define ( 'REDIRECT_URL', 'http://demofree.in/app/wordpress/connected.php' ); //TODO
		define ( 'REQUEST_TOKEN_URL', 'https://public-api.wordpress.com/oauth2/token' );
		define ( 'AUTHENTICATE_URL', 'https://public-api.wordpress.com/oauth2/authenticate' );

	}
	else { }
	
	if($db1 = mysqli_connect(HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME))
	{
		if(!mysqli_select_db($db1,DB_NAME)) {
			echo 'Erorr in selecting database'; exit();
		}
	}
	else {
		echo 'Erorr in database connection string'; exit();
	}
	
	function CheckUser($user_id = '', $oauth_provider = '', $oauth_uid = '', $oauth_username = '', $oauth_email = '')
	{
		if($user_id != '' && $oauth_provider != '')
		{
			$UserDetail_SQL = "SELECT * FROM `users_social`
			WHERE `user_id` = '$user_id' AND `oauth_provider` = '$oauth_provider' LIMIT 0,1";
			$result = mysql_query($UserDetail_SQL);
			
			if(mysql_num_rows($result) == 0)
			{
				if($oauth_provider == 'wordpress')
				{
					$access_token = $_SESSION['wordpress_access_token'];
					$UserDetail_Insert_SQL = "INSERT INTO `users_social`
					SET `user_id` = '$user_id', `oauth_provider` = '$oauth_provider', `oauth_access_token` = '$access_token'";
					mysql_query($UserDetail_Insert_SQL);
					
				}
				
				$UserDetail_SQL = "SELECT * FROM `users_social`
				WHERE `user_id` = '$user_id' AND `oauth_provider` = '$oauth_provider' LIMIT 0,1";
				$result = mysql_query($UserDetail_SQL);
				$result_arr = mysql_fetch_array($result);
				
				return $result_arr;
			}
			elseif(mysql_num_rows($result) == 1)
			{
				if($oauth_provider == 'wordpress')
				{
					$access_token = $_SESSION['wordpress_access_token'];
					
					$UserDetail_Update_SQL = "UPDATE `users_social`
					SET `oauth_access_token` = '$access_token' WHERE `oauth_provider` = '$oauth_provider' AND `user_id` = '$user_id' ";
					mysql_query($UserDetail_Update_SQL);
					
				}
				
				$UserDetail_SQL = "SELECT * FROM `users_social`
				WHERE `user_id` = '$user_id' AND `oauth_provider` = '$oauth_provider' LIMIT 0,1";
				$result = mysql_query($UserDetail_SQL);
				$result_arr = mysql_fetch_array($result);
				
				return $result_arr;
			}
		}
		else {
			return array();
		}
	}
	
	function GetUserDetail($user_id = '', $oauth_provider = '')
	{
		if($user_id != '' && $oauth_provider != '')
		{
			$UserDetail_SQL = "SELECT * FROM `users_social`
			WHERE `user_id` = '$user_id' AND `oauth_provider` = '$oauth_provider'";
			$result = mysql_query($UserDetail_SQL);
			
			if(mysql_num_rows($result) > 0)
			{
				$res_arr = array();
				while($arr = mysql_fetch_array($result))
				{
					$res_arr[] = $arr;
				}
				return $res_arr;
			}
			else {
				return array();
			}
		}
	}
?>