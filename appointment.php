<?php
$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "admin";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$state = $_POST['State'];
$name = $_POST['name'];
$email = $_POST['email'];
$number = $_POST['Number'];
$city = $_POST['City'];
$service = $_POST['service'];
$date = $_POST['date'];

$sql = "INSERT INTO registrations (state, name, email, number, city, service, appointment_date)
        VALUES ('$state', '$name', '$email', '$number', '$city', '$service', '$date')";

if ($conn->query($sql) === TRUE) {
    echo "Appointment booked successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>