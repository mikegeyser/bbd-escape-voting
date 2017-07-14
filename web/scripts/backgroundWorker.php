<?php

    require_once 'init.php';
    require_once 'twitterFunctions.php';

    // This script will run jobs in the background.
    // Only one instance of this script should run!

    mainLoop();
    function mainLoop() {
        Logger::debug('Background service has been started');

        while (true) {
            if (getCurrentState() === "TRUE") {
                // Loop here
              echo shell_exec('sh /var/www/cgi-bin/camera.sh');

              Logger::debug('compressing image...');
              shell_exec('sh jpegoptim -S 256 /home/pi/Desktop/image/jpg');
              Logger::debug('Compresseion done.');

                $output = array();
                $output = getrandomcomment();

                $result = -1;
                $commentid = -1;

                if(sizeof($output) != 0){

                    $handle = $output[0]["HANDLE"];
                    $comment = $output[0]["COMMENT"];
                    $commentid= $output[0]["COMMENTID"];

                    $result= tweetmessage("$comment - #BBDEscape",'/home/pi/Desktop/image.jpg');
                    Logger::debug('Tweeting...'.$comment.PHP_EOL);

                }else{
                    $result= tweetmessage("#BBDEscape",'/home/pi/Desktop/image.jpg');
                    Logger::debug('No comments at this moment...');
                }

                if ($result == 0) {
                    setTweetedBit($commentid);
                }

                Logger::debug('Loop');
            } else if (getCurrentState() === "DIE") {
                Logger::debug('Killing background thread');
                die();
            } else {
                Logger::debug('Background not active');
            }

            sleep(180);
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
        WHERE TWEETED = 0 AND TIME > (NOW() - interval 10 minute)
        ORDER BY TIME DESC LIMIT 1";

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
?>
