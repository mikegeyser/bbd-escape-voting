<?php
	$conn = new mysqli("127.0.0.1", "bbd", "password","Escape", 3306);
	$id = $_REQUEST["timeslotUpdate"];
	$topic = $_REQUEST["topic"];
	$start = $_REQUEST["start"];
	$end = $_REQUEST["end"];


	if ($result = $conn->query("UPDATE PRESENTER SET TOPIC = '$topic', START = '$start', END = '$end' WHERE PRESENTERID = $id")){
		echo "Updated successfully";
	}
	else {echo "Error updating";}

    header ("Location: ../admin.html");
?>
