<?php
    // Connect to Database
    $servername = "db";
    $username = getenv('MYSQL_USER');
    $password = getenv('MYSQL_PASSWORD');
    $dbname = getenv('MYSQL_DATABASE');

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }