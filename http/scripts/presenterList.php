<?php
	$conn = new mysqli("127.0.0.1", "bbd", "password","Escape", 3306);

	$sql = "SELECT PRESENTERID AS TIMESLOT, HANDLE, NAME, TOPIC, START, END FROM PRESENTER";

	$result = $conn->query($sql);
	$output = array();
	while($row = $result->fetch_assoc()){
	   	$output[]=$row;
	}

	echo json_encode($output);
?>
