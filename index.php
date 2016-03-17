<?php
require(__DIR__ . '/vendor/autoload.php');

$fb = new Facebook\Facebook([
  'app_id' => '192495190824190',
  'app_secret' => '07b067bb8867e10bc11636fa4bb6f49d',
  'default_graph_version' => 'v2.5',
  //'default_access_token' => '{access-token}', // optional
]);

$helper = $fb->getCanvasHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
  }
  
  if (! isset($accessToken)) {
  	echo 'No OAuth data could be obtained from the signed request. User has not authorized your app yet.';
  	exit;
  }
  
  // Logged in
  echo '<h3>Signed Request</h3>';
  var_dump($helper->getSignedRequest());
  
  echo '<h3>Access Token</h3>';
  var_dump($accessToken->getValue());