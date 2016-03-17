<?php
require(__DIR__ . '/vendor/autoload.php');

$fb = new Facebook\Facebook([
  'app_id' => '192495190824190',
  'app_secret' => '07b067bb8867e10bc11636fa4bb6f49d',
  'default_graph_version' => 'v2.5',
  //'default_access_token' => '{access-token}', // optional
]);

//$helper = $fb->getCanvasHelper();

try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get('/me?fields=id,name', '{access-token}');
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$user = $response->getGraphUser();

echo 'Name: ' . $user['name'];
// OR
// echo 'Name: ' . $user->getName();