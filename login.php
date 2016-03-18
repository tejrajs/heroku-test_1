<?php
require(__DIR__ . '/config.php');

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email', 'user_likes','user_posts','publish_actions']; // optional
$loginUrl = $helper->getLoginUrl('https://tejtestapp.herokuapp.com/login-callback.php', $permissions);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';