<?php

    require_once('init.php');
    require_once 'db.php';

    $sql = "SELECT KEYVALUE FROM KEYSTORE WHERE KEYID = 'BACKGROUND_ACTIVE'";
	$result = $conn->query($sql);
	$output = array();
	while($row = $result->fetch_assoc()){
	   	$output[]=$row;
	}

    echo print_r($output);

 ?>
