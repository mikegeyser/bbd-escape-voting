<?php

    require_once 'init.php';

    // This script will run jobs in the background.
    // Only only instance of this script should run!


    mainLoop();
    function mainLoop() {
        Logger::debug('Background service has been started');

        while (true) {
            if (getCurrentState() === "TRUE") {
                // Loop here
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

    }

    function popPhoto() {

    }

    function getRandomComment() {

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
