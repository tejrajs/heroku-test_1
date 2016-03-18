<?php
$helper = $fb->getCanvasHelper();

try {
	$accessToken = $helper->getAccessToken();
	$response = $fb->get('/me?fields=id,name,email', $accessToken);
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