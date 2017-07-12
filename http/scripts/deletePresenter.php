<?php
	$conn = new mysqli("127.0.0.1", "bbd", "password","Escape", 3306);
	$id = $_REQUEST["timeslot"];

	if ($result = $conn->query("DELETE FROM PRESENTER WHERE PRESENTERID = $id")){
		echo "Deleted successfully";
	}
	else {echo "Error deleting";}
?>