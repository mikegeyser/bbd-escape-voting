<?php

require_once 'init.php';

define('SUCCESS', 0);
define('E_IMAGE_NOT_FOUND', 1);
define('E_IMAGE_UPLOAD_FAILED', 2);
define('E_TWEET_FAILED', 3);

/**
 * Tweet message and image to twitter using credentials in config.init
 * @param  string $message   The message to tweet
 * @param  string $imagePath Path of the image file
 * @return int              0 (true?): success, 1: Image not found, 2:
 */
function tweetMessage($message, $imagePath) {
    Logger::debug("Tweeting message '{$message}' with image path '{$imagePath}'...");

    $consumerKey = $GLOBALS['config']["consumerKey"];
    $consumerSecret = $GLOBALS['config']["consumerSecret"];
    $accessToken = $GLOBALS['config']["accessToken"];
    $accessTokenSecret = $GLOBALS['config']["accessTokenSecret"];

    require_once('codebird-php-develop/src/codebird.php');

     \Codebird\Codebird::setConsumerKey("$consumerKey", "$consumerSecret");
        $cb = \Codebird\Codebird::getInstance();
        $cb->setToken("$accessToken", "$accessTokenSecret");
    $cb->setConnectionTimeout(10000);
        $cb->setTimeout(15000);

    $params = array(
        'status' => "$message",
    );

    // Attach optional image
    if ($imagePath != null) {

        if (!file_exists($imagePath)) {
            Logger::error("Image at {$imagePath} was not found!");
            return E_IMAGE_NOT_FOUND;
        }

        Logger::debug("Uploading image {$imagePath} to Twitter...");
        $reply = $cb->media_upload(array(
        	'media' => $imagePath
    	));
        Logger::debug("Image has been uploaded");
        if (!property_exists($reply, 'media_id_string')) {
            Logger::error("Failed to upload image {$imagePath}");
            Logger::error(print_r($reply, true));
            return E_IMAGE_UPLOAD_FAILED;
        }

    	$mediaID = $reply->media_id_string;
        $params = array(
            'status' => "$message",
            'media_ids' => $mediaID
        );
    }
    Logger::debug("Sending tweet...");
    $reply = $cb->statuses_update($params);
    $status = $reply->httpstatus;
    Logger::debug("Tweet has been posted! ".$reply->httpstatus);

    if ($status != 200) {
        Logger::error("Could not create twitter status. HTTP Returned {$status}");
        Logger::error(print_r($reply, true));
        return E_TWEET_FAILED;
    }

    return SUCCESS;
}

function startAutoTweet() {
    $consumerKey = $_REQUEST["consumerKey"];
    $consumerSecret = $_REQUEST["consumerSecret"];
    $accessToken = $_REQUEST["accessToken"];
    $accessTokenSecret = $_REQUEST["accessTokenSecret"];

    $conn = new mysqli("127.0.0.1", "bbd", "password","Escape", 3306);

	while (true){
	for ($i = 1; $i <= 5; $i++){
        	$sql = "SELECT COMMENTID, COMMENT, HANDLE FROM COMMENTS LEFT JOIN PRESENTER ON PRESENTER = PRESENTERID WHERE TWEETED = 0 AND TIME > (NOW() - interval 10 minute)  ORDER BY TIME DESC";

        	$result = $conn->query($sql);
	        $output = array();
       		while($row = $result->fetch_assoc()){
                	$output[]=$row;
	        }
	        $handle = $output[0]["HANDLE"];
		$comment = $output[0]["COMMENT"];
	echo sizeof($output);
		$myfile = fopen("name.txt", "r");
        	$track = fread($myfile, filesize("name.txt"));
	        fclose($myfile);

	        require_once('/var/www/html/scripts/codebird-php-develop/src/codebird.php');

        	 \Codebird\Codebird::setConsumerKey("$consumerKey", "$consumerSecret");
	        $cb = \Codebird\Codebird::getInstance();
	        $cb->setToken("$accessToken", "$accessTokenSecret");
		$cb->setConnectionTimeout(10000);
		$cb->setTimeout(15000);

		if (sizeof($output) == 0) {$stat = "$track #BBDEscape";}
	        else {$stat = "$handle $track - $comment #BBDEscape";}

		if ($i == 1){
			echo shell_exec('sh /var/www/cgi-bin/camera.sh');
        		$reply = $cb->media_upload(array(
        			'media' => '/home/pi/Desktop/image.jpg'
        		));

	       		$mediaID = $reply->media_id_string;
			$params = array('status' => $stat,'media_ids' => $mediaID);
		}
		else {$params = array('status' => $stat);}

		$reply = $cb->statuses_update($params);

	        $status = $reply->httpstatus;
        	echo "HTTP Response Code: $status";

		$id = $output[0]["COMMENTID"];
		if ($status == "200") {
			$sql = "UPDATE COMMENTS SET TWEETED = 1 WHERE COMMENTID = $id";
	        	$result = $conn->query($sql);
		}
	}
	sleep(300);
	}
}
 ?>
