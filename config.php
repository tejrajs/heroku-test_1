<?php
ob_start();
session_start();

define( 'DB_HOST', '85.10.205.173:3306' ); // set database host
define( 'DB_USER', 'tejrajstha' ); // set database user
define( 'DB_PASS', 'meteju@99' ); // set database password
define( 'DB_NAME', 'facebook_apps' ); // set database name
define( 'SEND_ERRORS_TO', 'tej.raj@bentraytech.com' ); //set email notification email address
define( 'DISPLAY_DEBUG', true ); //display db errors?

require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/include/class.db.php');

$db = new DB();

$fb = new Facebook\Facebook([
		'app_id' => '192495190824190',
		'app_secret' => '07b067bb8867e10bc11636fa4bb6f49d',
		'default_graph_version' => 'v2.5',
		//'default_access_token' => '{access-token}', // optional
]);