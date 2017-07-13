<?php

    require_once 'init.php';
    require_once 'twitterFunctions.php';

    // Get data from request


    require 'db.php';

	$sql = "SELECT MAX(AVERAGE) AS RATING, TIMESLOT,HANDLE, NAME, TOPIC FROM
                (SELECT AVG(RATING) AS AVERAGE,  TIMESLOT, HANDLE, NAME, TOPIC FROM VOTES LEFT JOIN PRESENTER ON PRESENTERID = TIMESLOT)
                AS MAXAVG";

 	$result = $conn->query($sql);

    Logger::debug($conn->error);
    
        $output = array();
        while($row = $result->fetch_assoc()){
                $output[]=$row;
        }
	$handle = $output[0]["HANDLE"];
	$topic = $output[0]["TOPIC"];
	$name = $output[0]["NAME"];

	$myfile = fopen("name.txt", "r");
	$track = fread($myfile, filesize("name.txt"));
	fclose($myfile);

    tweetMessage("The winner is $name: $handle, with the topic $topic  #BBDEscape", null);



?>
