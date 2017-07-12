<?php
	echo shell_exec('sh /var/www/cgi-bin/camera.sh'); //execute script to take picture

	$message = $_REQUEST["message"];

	$consumerKey = $_REQUEST["consumerKey"];
        $consumerSecret = $_REQUEST["consumerSecret"];
        $accessToken = $_REQUEST["accessToken"];
        $accessTokenSecret = $_REQUEST["accessTokenSecret"];


	require_once('/var/www/html/scripts/codebird-php-develop/src/codebird.php');

	 \Codebird\Codebird::setConsumerKey("$consumerKey", "$consumerSecret");
        $cb = \Codebird\Codebird::getInstance();
        $cb->setToken("$accessToken", "$accessTokenSecret");
	$cb->setConnectionTimeout(10000);
        $cb->setTimeout(15000);

	$reply = $cb->media_upload(array(
    	'media' => '/home/pi/Desktop/image.jpg'
	));

	$mediaID = $reply->media_id_string;

	$params = array(
    	'status' => "$message #BBDEscape",
    	'media_ids' => $mediaID
	);

	$reply = $cb->statuses_update($params);

	$status = $reply->httpstatus; 
	echo "HTTP Response Code: $status";
?>
