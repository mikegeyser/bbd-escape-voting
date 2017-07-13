<?php
    $name;
    
        if(!(isset($_REQUEST["name"])))
        {
            $name= "";
        }   
        else 
        	{
        		$name = $_REQUEST["name"];
        	}
    $presenterid= $_REQUEST["presenterid"];
	$rating = $_REQUEST["star"];
	$timeslot = $_REQUEST["presenterid"];
    $success = 'Thanks! Check the BBD twitter feed to see if your comment features.';
    $error = 'There was an error while submitting. Please try again later.';




    $cookieExists = isset($_COOKIE["$timeslot"]);
	$tweet = $_REQUEST["comment"];

    try
    {
        $conn = new mysqli("127.0.0.1", "bbd", "password","Escape", 3306); 

        if (!$cookieExists)
        {
            $result = $conn->query("INSERT INTO VOTES(RATING, TIMESLOT) VALUES ($rating, $timeslot)");
            //echo "Rating has been added";

            if ($result = $conn->query("INSERT INTO COMMENTS(COMMENT, PRESENTER, TIME, NAME) VALUES('$tweet', $presenterid, NOW(), '$name')"))
            {
                //echo "New comment captured!";
                $responseArray = array('type' => 'success', 'message' => $success);
            } 
            else 
            {//echo "Error capturing comment";
                $responseArray = array('type' => 'danger', 'message' => $error);
            }
        } 
        else 
        {
            //echo "Already rated.";
            if ($result = $conn->query("INSERT INTO COMMENTS(COMMENT, PRESENTER, TIME, NAME) VALUES('$tweet', $presenterid, NOW(), '$name')"))
            {
                //echo "New comment captured!";
                $responseArray = array('type' => 'success', 'message' => $success);
            } 
            else 
            {//echo "Error capturing comment";
                $responseArray = array('type' => 'danger', 'message' => $error);
            }
        }


        setcookie($timeslot,"1", time() + (86400 * 300), "/"); // 86400 = 1 day

    }
    catch (\Exception $e)
    {
        $responseArray = array('type' => 'danger', 'message' => $error);
    }

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $encoded = json_encode($responseArray);

        header('Content-Type: application/json');

        echo $encoded;
    }
    else {
        echo $responseArray['message'];
    }

	
?>
