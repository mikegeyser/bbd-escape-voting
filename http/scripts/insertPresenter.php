<?php
	$conn = new mysqli("127.0.0.1", "bbd", "password","Escape", 3306); //change ip add
	$handle = $_REQUEST["handle"];
	$name = $_REQUEST["name"];
	$topic = $_REQUEST["topic"];
	$start = $_REQUEST["start"];
	$end = $_REQUEST["end"];

	if ($result = $conn->query("INSERT INTO PRESENTER(HANDLE, NAME, TOPIC, START, END) VALUES ('$handle', '$name', '$topic', '$start', '$end')")){
		echo "Inserted successfully";
	}
	else {echo "Error inserting";}
?>
