<?php
    $name="";
    
        if(!(isset($_REQUEST["name"]))){
            $name= "";
        }   else {$name = $_REQUEST["name"];}

	$rating = $_REQUEST["star"];
	$timeslot = $_REQUEST["timeslot"];
    $cookieExists = isset($_COOKIE["$timeslot"]);
	$tweet = $_REQUEST["comment"];

	$conn = new mysqli("127.0.0.1", "bbd", "password","Escape", 3306); 

	if (!$cookieExists){
        // TODO: error handling
		$result = $conn->query("INSERT INTO VOTES(RATING, TIMESLOT) VALUES ($rating, $timeslot)");
        echo "Rating has been added";
	} else {
        echo "Already rated.";
    }

	if ($result = $conn->query("INSERT INTO COMMENTS(COMMENT, PRESENTER, TIME) VALUES('$tweet', $timeslot, NOW())")){
		echo "New comment captured!";
	} else {echo "Error capturing comment";}

    setcookie($timeslot,"1", time() + (86400 * 300), "/"); // 86400 = 1 day
?>
