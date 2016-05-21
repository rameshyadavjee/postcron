<?php @session_start();
	
	if($_SERVER['HTTP_HOST'] == 'www.demofree.in' || $_SERVER['HTTP_HOST'] == 'demofree.in' )
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
	}
	else
	{
		define("HOSTNAME","localhost");
		define("DB_USERNAME","root");
		define("DB_PASSWORD","");
		define("DB_NAME","postcron");
		
		// FOR FACEBOOK APPLICATION ID
		define('FB_AppID','');
		define('FB_AppSecret','');
		
		// FOR TWITTER APPLICATION ID
		define('TWITTER_CONSUMER_KEY', '');
		define('TWITTER_CONSUMER_SECRET', '');
	}
	
	//echo HOSTNAME ." * " .DB_USERNAME ." * " .DB_PASSWORD ," * ". $db1;
	
	if($db1 = mysqli_connect(HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME))
	{
		if(!mysqli_select_db($db1,DB_NAME)) {
			echo 'Erorr in selecting database'; exit();
		}
	}
	else {
		echo 'Erorr in database connection string'; exit();
	}
	
	//echo "<pre>". print_r($db1);
	function CheckUser($user_id = '', $oauth_provider = '', $oauth_uid = '', $oauth_username = '', $oauth_email = '')
	{
		if($user_id != '' && $oauth_provider != '' )//&& $oauth_uid != '' && $oauth_username != ''
		{
			$UserDetail_SQL = "SELECT * FROM `users_social`
			WHERE `user_id` = '$user_id' AND `oauth_provider` = '$oauth_provider' AND `oauth_uid` = '$oauth_uid' LIMIT 0,1";
			
			$result = mysqli_query($db1,$UserDetail_SQL);
						
			if(mysqli_num_rows($db1,$result)==0)
			{
				if($oauth_provider == 'facebook')
				{
					$FB_AppID = FB_AppID;
					
					$fb_access_token = $_SESSION['fb_'.$FB_AppID.'_access_token'];
					$fb_access_code = $_SESSION['fb_'.$FB_AppID.'_code'];
					
					$UserDetail_Insert_SQL = "INSERT INTO `users_social`
					SET `user_id` = '$user_id', `oauth_email` = '$oauth_email', `oauth_provider` = '$oauth_provider', `oauth_uid` = '$oauth_uid',
					`oauth_username` = '$oauth_username', `oauth_access_token` = '$fb_access_token', `oauth_token_secret` = '$fb_access_code' ";
					mysqli_query($db1,$UserDetail_Insert_SQL);
				}
				elseif($oauth_provider == 'twitter')
				{
					$twitter_oauth_verifier = $_SESSION['oauth_verifier'];
					$twitter_access_token = $_SESSION['oauth_token'];
					$twitter_access_secret = $_SESSION['oauth_token_secret'];
					
					$UserDetail_Insert_SQL = "INSERT INTO `users_social`
					SET `user_id` = '$user_id', `oauth_email` = '$oauth_email', `oauth_provider` = '$oauth_provider', `oauth_uid` = '$oauth_uid',
					`oauth_username` = '$oauth_username', `oauth_access_token` = '$twitter_access_token', `oauth_token_secret` = '$twitter_access_secret',
					`oauth_verifier` = '$twitter_oauth_verifier'";
					mysqli_query($db1,$UserDetail_Insert_SQL);
				}
				elseif($oauth_provider == 'blogger')
				{
					$blogger_blogid = $_SESSION['blogger_blogid'];
					$blogger_access_token = $_SESSION['blogger_access_token'];
					
					 $UserDetail_Insert_SQL = "INSERT INTO `users_social`
					SET `user_id` = '$user_id', `oauth_provider` = '$oauth_provider', 
					`blogger_id` = '$blogger_blogid', `oauth_access_token` = '$blogger_access_token'";
					mysqli_query($db1,$UserDetail_Insert_SQL);
				}
				
				$UserDetail_SQL = "SELECT * FROM `users_social`
				WHERE `user_id` = '$user_id' AND `oauth_provider` = '$oauth_provider' LIMIT 0,1";
				$result = mysqli_query($db1,$UserDetail_SQL);
				$result_arr = mysqli_fetch_array($result,MYSQLI_NUM);

				return $result_arr;
			}
			elseif(mysqli_num_rows($db1,$result)==1)
			{
				if($oauth_provider == 'facebook')
				{
					$FB_AppID = FB_AppID;
					
					$fb_access_token = $_SESSION['fb_'.$FB_AppID.'_access_token'];
					$fb_access_code = $_SESSION['fb_'.$FB_AppID.'_code'];
					
					$UserDetail_Update_SQL = "UPDATE `users_social`
					SET `oauth_username` = '$oauth_username', `oauth_email` = '$oauth_email',
					`oauth_access_token` = '$fb_access_token', `oauth_token_secret` = '$fb_access_code' 
					WHERE `user_id` = '$user_id' AND `oauth_provider` = '$oauth_provider' AND `oauth_uid` = '$oauth_uid' ";
					mysqli_query($db1,$UserDetail_Update_SQL);
				}
				elseif($oauth_provider == 'twitter')
				{
					$twitter_oauth_verifier = $_SESSION['oauth_verifier'];
					$twitter_access_token = $_SESSION['oauth_token'];
					$twitter_access_secret = $_SESSION['oauth_token_secret'];
					
					$UserDetail_Update_SQL = "UPDATE `users_social`
					SET `oauth_username` = '$oauth_username', `oauth_email` = '$oauth_email',
					`oauth_access_token` = '$twitter_access_token', `oauth_token_secret` = '$twitter_access_secret',
					`oauth_verifier` = '$twitter_oauth_verifier'
					WHERE `user_id` = '$user_id' AND `oauth_provider` = '$oauth_provider' AND `oauth_uid` = '$oauth_uid' ";
					
					mysqli_query($db1,$UserDetail_Update_SQL);
				}
				elseif($oauth_provider == 'blogger')
				{
					$blogger_blogid = $_SESSION['blogger_blogid'];
					$blogger_access_token = $_SESSION['blogger_access_token'];
					
					 $UserDetail_Update_SQL = "UPDATE `users_social`
					SET `oauth_provider` = '$oauth_provider', 
					`blogger_id` = '$blogger_blogid', `oauth_access_token` = '$blogger_access_token'
					WHERE `user_id` = '$user_id' AND `oauth_provider` = '$oauth_provider'  ";
					
					mysqli_query($db1,$UserDetail_Update_SQL);
				}
				
				
				$UserDetail_SQL = "SELECT * FROM `users_social`
				WHERE `user_id` = '$user_id' AND `oauth_provider` = '$oauth_provider'  LIMIT 0,1";//AND `oauth_uid` = '$oauth_uid'
				$result = mysqli_query($db1,$UserDetail_SQL);
				$result_arr = mysqli_fetch_array($result,MYSQLI_NUM);

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
			$result = mysqli_query($db1,$UserDetail_SQL);
			
			if(mysqli_num_rows($result) > 0)
			{
				$res_arr = array();
				while($arr = mysqli_fetch_array($result,MYSQLI_NUM))
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