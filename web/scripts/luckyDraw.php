<?php
    require_once 'init.php';
    require_once 'twitterFunctions.php';

	$conn = new mysqli("127.0.0.1", "bbd", "password","Escape", 3306);

	$sql = "SELECT comments.COMMENT, comments.NAME FROM comments WHERE comments.NAME != '' ORDER BY RAND() LIMIT 1";

	$result = $conn->query($sql);
	$output = array();
	while($row = $result->fetch_assoc()){
	   	$output[]=$row;
	}
    $comment = $output[0]["COMMENT"];
    $name = $output[0]["NAME"];
   
	tweetMessage("The lucky comment:$comment from $name has won! - #BBDEscape", null);
?>
