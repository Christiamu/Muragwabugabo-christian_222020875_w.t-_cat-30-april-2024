<?php
    // Connection details
    $hostname = "localhost";
    $user = "christia";
    $pass = "chris";
    $database = "library";


    // Creating connection
    $connection = new mysqli($hostname, $user, $pass, $database);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
?>