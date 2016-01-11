<?php
$dbservername = "localhost";
$dbusername = "0892400";
$dbpassword = "aifiesha";
$dbname = "0892400";

// Create connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

