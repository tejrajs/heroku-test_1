<?php
if(!isset($_SESSION['facebook_access_token'])){
	echo 'No OAuth data could be obtained from the signed request. User has not authorized your app yet.';
	exit;
}else{
	$accessToken = $_SESSION['facebook_access_token'];
}