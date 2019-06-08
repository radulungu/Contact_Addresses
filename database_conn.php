<?php

	require_once 'config_database.php';

    $conn = new mysqli($CONFIG["servername"], $CONFIG["username"], $CONFIG["password"], $CONFIG["db"]);

    if ($conn->connect_error) {

        die("Connection failed: " . $conn->connect_error);
    }
    
?>