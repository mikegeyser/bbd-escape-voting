<?php

    require_once 'init.php';
    require_once 'twitterFunctions.php';

    // Get data from request

    
        $conn = new mysqli("127.0.0.1", "bbd", "password","Escape", 3306); 
	$sql = "SELECT MAX(AVERAGE) AS RATING, TIMESLOT,HANDLE, NAME, TOPIC FROM
                (SELECT AVG(RATING) AS AVERAGE,  TIMESLOT, HANDLE, NAME, TOPIC FROM VOTES LEFT JOIN PRESENTER ON PRESENTERID = TIMESLOT)
                AS MAXAVG";

 	$result = $conn->query($sql);
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

    tweetMessage("The winner of $track is $name: $handle, with the topic $topic  #BBDEscape", null);
    


?>
