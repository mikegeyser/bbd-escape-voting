<?php
	$conn = new mysqli("127.0.0.1", "bbd", "password","Escape", 3306);
	$sql = "SELECT NAME AS NAME, HANDLE, TOPIC, START, END, PRESENTERID FROM PRESENTER LIMIT 2,1";

	$result = $conn->query($sql);
	$output = array();
	while($row = $result->fetch_assoc()){
	   	$output[]=$row;
	}

	echo json_encode($output);
?>
