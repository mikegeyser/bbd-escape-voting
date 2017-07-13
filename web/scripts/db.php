<?php
    require_once 'init.php';

    $servername = "127.0.0.1";
    $username = "bbd";
    $password = "password";
    $database = "Escape";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        Logger::error("Failed to connect to database: ".$conn->connect_error);
        Logger::error('$_SERVER = '."\n".print_r($_SERVER, true));
    }
 ?>
