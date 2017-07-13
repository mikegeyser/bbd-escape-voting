<?php

    require_once ('init.php)';
     require_once('twitterFunctions.php');
    require 'db.php'
                  
    // This script will run jobs in the background.
    // Only one instance of this script should run!
  

    mainLoop();
    function mainLoop() {
        Logger::debug('Background service has been started');

        while (true) {
            if (getCurrentState() === "TRUE") {
                // Loop here
              echo shell_exec('sh /var/www/cgi-bin/camera.sh');
                $output = array(); 
                $output = getrandomcomment();
                if(sizeof($output) != 0){
                      
                    $handle = $output[0]["HANDLE"];
                    $comment = $output[0]["COMMENT"];
                    $commentid= $output[0]["COMMENTID"];
                    
                    $result= tweetmessage("$comment - #BBDEscape",'/home/pi/Desktop/image.jpg');
                }else{
                    $result= tweetmessage("#BBDEscape",'/home/pi/Desktop/image.jpg'); 
                }
                
                Logger::debug('Loop');
            } else if (getCurrentState() === "DIE") {
                Logger::debug('Killing background thread');
                die();
            } else {
                Logger::debug('Background not active');
            }

            /*
            Logic:
            Check if the background thread should still be running
            Add photo to the buffer
            Pop the first photo from the buffer
            Fetch a random row from the comments that has not been tweeted before
            Make a tweet

            sleep for 1 minute
             */

            sleep(60);
        }

    }

    function takePhotoToBuffer() {
        
        echo shell_exec('sh /var/www/cgi-bin/camera.sh');
        
    }

    function popPhoto() {

    }

    function getRandomComment() {
        $sql = "SELECT TOP 1 COMMENTID, COMMENT, HANDLE FROM COMMENTS LEFT JOIN PRESENTER ON PRESENTER = PRESENTERID WHERE TWEETED = 0 AND TIME > (NOW() - interval 10 minute)  ORDER BY TIME DESC";

        	$result = $conn->query($sql);
	        $output = array();
       		while($row = $result->fetch_assoc()){
                	$output[]=$row;
            }
  
        return $output;
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
