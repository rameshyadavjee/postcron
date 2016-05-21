<?php


require_once '../src/Google_Client.php';
require_once '../src/contrib/Google_PlusService.php';

session_start();

$client = new Google_Client();
$client->setApplicationName("Social Post");
// Visit https://code.google.com/apis/console to generate your
// oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
 $client->setClientId('306872436748-2rsboit5k41jocqq97lsrvelo7af1tkm.apps.googleusercontent.com');
 $client->setClientSecret('oDusrc16tKHR2pWnml1DuHrz');
 $client->setRedirectUri('http://demofree.in/app/google/plus/');
 $client->setDeveloperKey('306872436748@developer.gserviceaccount.com');
$plus = new Google_PlusService($client);

 // Create a state token to prevent request forgery.
  // Store it in the session for later validation.
  /*$state = md5(rand());
  $app['session']->set('state', $state);
  // Set the client ID, token state, and application name in the HTML while
  // serving it.
  return $app['twig']->render('index.html', array(
      'CLIENT_ID' => '306872436748-2rsboit5k41jocqq97lsrvelo7af1tkm.apps.googleusercontent.com',
      'STATE' => $state,
      'APPLICATION_NAME' => 'Social Post'
  ));*/

 
?>
<!-- The top of file index.html -->
<html itemscope itemtype="http://schema.org/Article">
<head>
  <!-- BEGIN Pre-requisites -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js">
  </script>
  <script type="text/javascript">
    (function () {
      var po = document.createElement('script');
      po.type = 'text/javascript';
      po.async = true;
      po.src = 'https://plus.google.com/js/client:plusone.js?onload=start';
      var s = document.getElementsByTagName('script')[0];
      s.parentNode.insertBefore(po, s);
    })();
  </script>
  <!-- END Pre-requisites -->
</head>
<body>
<!-- Add where you want your sign-in button to render -->
<div id="signinButton">
  <span class="g-signin"
    data-scope="https://www.googleapis.com/auth/plus.login"
    data-clientid="YOUR_CLIENT_ID"
    data-redirecturi="postmessage"
    data-accesstype="offline"
    data-cookiepolicy="single_host_origin"
    data-callback="signInCallback">
  </span>
</div>
<div id="result"></div>
<!-- Last part of BODY element in file index.html -->
<script type="text/javascript">
function signInCallback(authResult) {
  if (authResult['code']) {

    // Hide the sign-in button now that the user is authorized, for example:
    $('#signinButton').attr('style', 'display: none');

    // Send the code to the server
    $.ajax({
      type: 'POST',
      url: 'plus.php?storeToken',
      contentType: 'application/octet-stream; charset=utf-8',
      success: function(result) {
        // Handle or verify the server response if necessary.

        // Prints the list of people that the user has allowed the app to know
        // to the console.
        console.log(result);
        if (result['profile'] && result['people']){
          $('#results').html('Hello ' + result['profile']['displayName'] + '. You successfully made a server side call to people.get and people.list');
        } else {
          $('#results').html('Failed to make a server-side call. Check your configuration and console.');
        }
      },
      processData: false,
      data: authResult['code']
    });
  } else if (authResult['error']) {
    // There was an error.
    // Possible error codes:
    //   "access_denied" - User denied access to your app
    //   "immediate_failed" - Could not automatially log in the user
    // console.log('There was an error: ' + authResult['error']);
  }
}
</script>

<?php
// Ensure that this is no request forgery going on, and that the user
  // sending us this connect request is the user that was supposed to.
  if ($request->get('state') != ($app['session']->get('state'))) {
    return new Response('Invalid state parameter', 401);
  }
	
	
	$code = $request->getContent();
  $gPlusId = $request->get['gplus_id'];
  // Exchange the OAuth 2.0 authorization code for user credentials.
  $client->authenticate($code);

  $token = json_decode($client->getAccessToken());
  // Verify the token
  $reqUrl = 'https://www.googleapis.com/oauth2/v1/tokeninfo?access_token=' .
          $token->access_token;
  $req = new Google_HttpRequest($reqUrl);

  $tokenInfo = json_decode(
      $client::getIo()->authenticatedRequest($req)->getResponseBody());

  // If there was an error in the token info, abort.
  if ($tokenInfo->error) {
    return new Response($tokenInfo->error, 500);
  }
  // Make sure the token we got is for the intended user.
  if ($tokenInfo->userid != $gPlusId) {
    return new Response(
        "Token's user ID doesn't match given user ID", 401);
  }
  // Make sure the token we got is for our app.
  if ($tokenInfo->audience != CLIENT_ID) {
    return new Response(
        "Token's client ID does not match app's.", 401);
  }

  // Store the token in the session for later use.
  $app['session']->set('token', json_encode($token));
  $response = 'Succesfully connected with token: ' . print_r($token, true);
	
?>
</body>
<!-- ... -->
</html>
