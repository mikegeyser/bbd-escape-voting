<?php
    $name;

        if(!(isset($_POST["name"])))
        {
            $name= "";
        }
        else
        	{
        		$name = $_POST["name"];
        	}
    $presenterid= $_POST["presenterid"];
	$rating = $_POST["star"];
	$timeslot = $_POST["presenterid"];
    $tweet = $_POST["comment"];
 

    $cookieExists = isset($_COOKIE["$timeslot"]);
	

    $conn = new mysqli("127.0.0.1", "bbd", "password","Escape", 3306);

        if (!$cookieExists)
        {
            $result = $conn->query("INSERT INTO VOTES(RATING, TIMESLOT) VALUES ($rating, $timeslot)");
            $status = 'ok';
        }
        if ($result = $conn->query("INSERT INTO COMMENTS(COMMENT, PRESENTER, TIME, NAME) VALUES('$tweet', $presenterid, NOW(), '$name')"))
        {

            //echo "New comment captured!";
            $status = 'ok';
        }
        else
        {//echo "Error capturing comment";
            $status = 'err';
        }

    setcookie($timeslot,"1", time() + (86400 * 300), "/"); // 86400 = 1 day

        // Output status
    echo $status;die;



?>
