<?php
    // This script is used for signalling the start and stop
    // of the background thread. It should only start the background
    // loop if it is not already running.

    /*
    LOGIC:

    Client needs to send the correct credentails
     */

     require_once 'init.php';

     if (! array_key_exists('active', $_REQUEST)) {
         die("Please pass in the 'active' field. active=<TRUE|FALSE|DIE>".PHP_EOL);
     }

     require 'db.php';
     $newState = $conn->real_escape_string($_REQUEST['active']);

     if (!$newState === 'TRUE' || !$newState === 'FALSE' || !$newState === 'DIE') {
         Logger::error('Invalid argument to backgroundManager. active='.$newState);
         echo 'Invalid argument active='.$newState.PHP_EOL;
         $conn->close();
         die();
     }

     Logger::debug("Setting background state to ".$newState);

     $sql = "UPDATE KEYSTORE SET KEYVALUE='{$newState}' WHERE KEYID='BACKGROUND_ACTIVE'";

     if ($conn->query($sql) === TRUE) {
         echo "Thread signalled succesfully";
         Logger::debug('Background thread has been signalled to active='.$newState.PHP_EOL);
     } else {
         echo "Error updating record: " . $conn->error;
         Logger::error("Error updating record: " . $conn->error);
     }

     $conn->close();

     // backgroundWorker.php will now pull the state and start/stop

 ?>
