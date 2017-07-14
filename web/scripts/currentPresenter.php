<?php
	$conn = new mysqli("127.0.0.1", "bbd", "password","Escape", 3306);
	$sql = "SELECT * FROM PRESENTER WHERE NOW() BETWEEN START AND END";

	$result = $conn->query($sql);
	$output = array();
	while($row = $result->fetch_assoc()){
	   	$output[]=$row;
	}

	echo json_encode($output);
?>