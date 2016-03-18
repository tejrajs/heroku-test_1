<?php
$helper = $fb->getCanvasHelper();

try {
	$accessToken = $helper->getAccessToken();
	// Returns a `Facebook\FacebookResponse` object
	$response = $fb->get('/me?fields=id,name,email', $accessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
	echo 'Graph returned an error: ' . $e->getMessage();
	exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
	exit;
}