<?php
	$conn = new mysqli("127.0.0.1", "bbd", "password","Escape", 3306);
    $sql = "SELECT * FROM presenter";
    
    $result = $conn->query($sql);
    $id_array[] = array();
    while($row = $result->fetch_assoc()){
        $id_array[] = $row['PRESENTERID'];
    }
    $ID = $id_array[2];
    
	if ($res = $conn->query("DELETE FROM presenter WHERE PRESENTERID=" .$ID)){
		echo "Deleted successfully";
        $id_array[] = array();
	}
	else {echo "Error deleting";}
?>