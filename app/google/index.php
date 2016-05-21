<?php
require_once 'src/Google_Client.php';
require_once 'src/contrib/Google_PlusService.php';

// Set your cached access token. Remember to replace $_SESSION with a
// real database or memcached.
session_start();

$client = new Google_Client();
$client->setApplicationName('Google+ PHP Starter Application');
// Visit https://code.google.com/apis/console?api=plus to generate your
// client id, client secret, and to register your redirect uri.
$client->setClientId('544254302461-4uqtakj097oog2nps372pt33kpp83lbd.apps.googleusercontent.com');
$client->setClientSecret('G-2AoPsOihKafzwQqaWlrkSL');
$client->setRedirectUri('http://demofree.in/app/google/index.php');
$client->setDeveloperKey('544254302461-4uqtakj097oog2nps372pt33kpp83lbd@developer.gserviceaccount.com');
$plus = new Google_PlusService($client);

if (isset($_GET['code'])) {
  $client->authenticate();
  $_SESSION['token'] = $client->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
  $client->setAccessToken($_SESSION['token']);
}

if ($client->getAccessToken()) {
  $activities = $plus->activities->listActivities('me', 'public');
  print 'Your Activities: <pre>' . print_r($activities, true) . '</pre>';

  // We're not done yet. Remember to update the cached access token.
  // Remember to replace $_SESSION with a real database or memcached.
  $_SESSION['token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
  echo $authUrl.'<br>';
  print "<a href='$authUrl'>Connect Me!</a>";
}