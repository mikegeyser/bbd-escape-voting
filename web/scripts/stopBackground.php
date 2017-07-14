<?php

    require_once('init.php');
    require_once 'db.php';

    $sql = "UPDATE KEYSTORE SET KEYVALUE='FALSE' WHERE KEYID='BACKGROUND_ACTIVE'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        Logger::debug('Background thread has been signalled to stop.');
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $sql = "SELECT KEYVALUE FROM KEYSTORE WHERE KEYID = 'BACKGROUND_ACTIVE'";
    $result = $conn->query($sql);
    $output = array();
    while($row = $result->fetch_assoc()){
        $output[]=$row;
    }

    echo print_r($output);

 ?>
