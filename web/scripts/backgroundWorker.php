<?php

    require_once 'init.php';
    require_once 'twitterFunctions.php';

    // This script will run jobs in the background.
    // Only one instance of this script should run!

    mainLoop();
    function mainLoop() {
        Logger::debug('Background service has been started');

        // 10 Tweets + 1 Photo every 10 minutes
        while (true) {
            if (getCurrentState() === "TRUE") {
                // Loop here
                takePhoto();

                $output = getrandomcomment();

                if(sizeof($output) != 0){
                    foreach( $output as $tweet_record ) {
                        tweetComment($tweet_record);
                    }                    
                }else{
                    Logger::debug('No comments at this moment...');
                }

                Logger::debug('Loop');
            } else if (getCurrentState() === "DIE") {
                Logger::debug('Killing background thread');
                die();
            } else {
                Logger::debug('Background not active');
            }

            sleep(600);
        }

    }

    function takePhotoToBuffer() {

        echo shell_exec('sh /var/www/cgi-bin/camera.sh');

    }

    function popPhoto() {

    }

    function getRandomComment() {
        require 'db.php';
        $sql = "SELECT A.COMMENTID, A.COMMENT, B.HANDLE FROM COMMENTS as A
        LEFT JOIN PRESENTER as B
        ON PRESENTER = PRESENTERID
        WHERE TWEETED = 0
        ORDER BY TIME DESC LIMIT 10";

        	$result = $conn->query($sql);

            if (!$result) {
                Logger::error($conn->error);
                die('error in sql');
            }


	        $output = array();
       		while($row = $result->fetch_assoc()){
                	$output[]=$row;
            }

        $conn->close();
        return $output;
    }

    function setTweetedBit($commentid) {

        require 'db.php';

        $sql = "UPDATE COMMENTS SET TWEETED='1' WHERE COMMENTID=$commentid";

        if ($conn->query($sql) === TRUE) {
            //echo "Thread signalled succesfully";
            Logger::debug('Set tweeted bit on commentid '.$commentid);
        } else {
            echo "Error updating record: " . $conn->error;
            //Logger::error("Error updating record: " . $conn->error);
        }

        $conn->close();
    }

    function getCurrentState() {
        require 'db.php';

        $sql = "SELECT KEYVALUE FROM KEYSTORE WHERE KEYID = 'BACKGROUND_ACTIVE'";
        $result = $conn->query($sql);

        $currentState = 'ERROR';

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $currentState = $row['KEYVALUE'];
        } else {
            Logger::error('Could not find BACKGROUND_ACTIVE in Table KEYSTORE!');
        }

        $conn->close();

        Logger::debug($currentState);
        return $currentState;
    }

    function tweetComment($tweet_record) {
        $handle = $tweet_record["HANDLE"];
        $comment = $tweet_record["COMMENT"];
        $commentid = $tweet_record["COMMENTID"];

        $result = tweetmessage($comment.' - #BBDEscape @BBDSoftware','');
        Logger::debug('Tweeting...'.$comment.PHP_EOL);

        if ($result == 0) {
            setTweetedBit($commentid);
        } else {
            Logger::error('Problem tweeting: '.$result);        
        }
    }

    function takePhoto(){
        echo shell_exec('sh /var/www/cgi-bin/camera.sh');

        Logger::debug('compressing image...');
        shell_exec('sh jpegoptim -S 256 /home/pi/Desktop/image/jpg');
        Logger::debug('compression done!');

        Logger::debug('tweeting image...');
        $result= tweetmessage('#BBDEscape @BBDSoftware','/home/pi/Desktop/image.jpg');
        Logger::debug('tweeting image done!');
    }
?>
