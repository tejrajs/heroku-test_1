<?php
if(!isset($_SESSION['facebook_access_token'])){
	header('Location: login-callback.php');
}else{
	$accessToken = $_SESSION['facebook_access_token'];
}