<?php @session_start();
	require_once('includes/config.php');	
	require_once("app/twitter/codebird.php");
	require_once("app/twitter/twitteroauth.php");
	require_once('app/facebook/facebook.php');
	if(!isset($_SESSION['userid']) || $_SESSION['userid'] == '')
	{
		header('Location:index.php');
		exit();
	}	
	$user_id = $_SESSION['userid'];
	
	$UserDetail_SQL = "SELECT * FROM `users_social` WHERE `user_id` = '$user_id'";
	$facebook = 0;
	$twitter = 0;
	$blogger = 0;
	
	$result = mysql_query($db1,$UserDetail_SQL);
	if(mysqli_num_rows($result)>0)
	{
		while($usrarr = mysqli_fetch_array($result,MYSQLI_NUM))
		{
			if($usrarr['oauth_provider'] == 'facebook') {
				$facebook = 1;
			}
			elseif($usrarr['oauth_provider'] == 'twitter') {
				$twitter = 1;
			}
			elseif($usrarr['oauth_provider'] == 'blogger') {
				$blogger = 1;
			}
		}
	}

	if(isset($_POST['btn_submit']))
	{
		$msg = 'fail';
		$message = $_POST['txt_message'];		
				
		if($message != '')
		{			
			
			if(count($_POST['socials'])>0)
			{
			foreach($_POST['socials'] as $key=> $value)
			{
				 if($value=='facebook')
				 {
				 	if($facebook == 1)
						{
				$facebook = new Facebook(array(
					'appId'  => FB_AppID,
					'secret' => FB_AppSecret,
				));
			
								
				$result = GetUserDetail($_SESSION['userid'],'facebook');				
				
				
				if(!empty($result))
				{
					$sendTo = $result[0]['oauth_uid'];
					 $access_token = $result[0]['oauth_access_token'];
					
					$attachment = array('message' => $message);
						
					$attachment = array
					 (
					 'access_token'=>$facebook->getAccessToken(),
					 'message' => $message,
					 'name' => 'I Asked Bert',
					 'caption' => 'Bert replied:',
					 'link' => 'http://apps.facebook.com/askbert/',
					 'description' => 'NO',
					 'picture' => 'http://www.facebookanswers.co.uk/img/misc/question.jpg'
					 );
					 $result = $facebook->api($sendTo.'/feed/','post',$attachment);	
						
					$result = $facebook->api('/me/feed','post', $attachment);									
					//print_r($result);

					 $msg = 'success';					
				}
				
				
			}
				 }
				 
				 if($value=='twitter')
				 {
				 	if($twitter == 1)
						{
				$User_TwitterDetails = GetUserDetail($_SESSION['userid'],'twitter');
				if(!empty($User_TwitterDetails))
				{
					\Codebird\Codebird::setConsumerKey(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET);
					$cb = \Codebird\Codebird::getInstance();
					
					foreach($User_TwitterDetails as $TwitterUser)
					{
						$accessToken = $TwitterUser['oauth_access_token'];
						$accessTokenSecret = $TwitterUser['oauth_token_secret'];
						
						$cb->setToken($accessToken, $accessTokenSecret);
						
						$params = array('status' => $message.', '.$description);
						$reply = $cb->statuses_update($params);
					}
					$msg = 'success';
				}
			}
				 }
				 
				 if($value=='blogger')
				 {
				 	if($blogger == 1)
						{
				$User_BloggerDetails = GetUserDetail($_SESSION['userid'],'blogger');
				if(!empty($User_BloggerDetails))
				{
				
					foreach($User_BloggerDetails as $BloggerUser)
					{
						
					try {
						$blogId=$BloggerUser['blogger_id'];
						$accessToken=$BloggerUser['oauth_access_token'];
						$postTitle = $message;
								$postContent = $message;
								$url = 'https://www.googleapis.com/blogger/v3/blogs/'.$blogId.'/posts/';
								$body = ' { "kind": "blogger#post", "blog": {"id": "'.$blogId.'"}, "title": "'.$postTitle.'", "content": "'.$postContent.'" }';
								$headerQuery = array();
								$headerQuery[] = 'Authorization: OAuth '.$accessToken;
								$headerQuery[] = 'Content-Length: '.strlen($body);
								$headerQuery[] = 'Content-Type: application/json';
								$ch = curl_init();
								curl_setopt($ch, CURLOPT_URL, $url);
								curl_setopt($ch, CURLOPT_HTTPHEADER, $headerQuery);
								curl_setopt($ch, CURLOPT_POST, TRUE);
								curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
								curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
								curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
								curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
								curl_setopt($ch, CURLINFO_HEADER_OUT, TRUE);
								$data = curl_exec($ch);
								/*var_dump(curl_getinfo($ch,CURLINFO_HEADER_OUT));
								echo "<br><br><br>".$data;*/
								//echo curl_errno($ch);
							$response = json_decode($data);
							
						
					}	
					catch (FacebookApiException $e) {
						error_log($e);
						$user = null;
					}
						
						
						
						
					}
					$msg = 'success';
				}
			}
				 }
			}
			}
			
			//echo 'Twitter '.$twitter;
		
			
		}		
		header('Location:dashboard.php?msg='.$msg);
		exit();
	}
	
?>