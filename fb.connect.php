<?php
if(!isset($_SESSION['facebook_access_token'])){
	$helper = $fb->getRedirectLoginHelper();
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
	if (isset($accessToken)) {
		header('Location: login-callback.php');
	}
}else{
	$accessToken = $_SESSION['facebook_access_token'];
}