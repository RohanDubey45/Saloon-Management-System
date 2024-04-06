<?php

$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "admin";
error_reporting(0);

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
    // echo "Connection successful <br>";
}
?>