<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: adminLogin.php');
    exit;
}
?>
<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "admin";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM registrations WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Record deleted successfully. <a href='admin.php'>Back to Records</a>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}

mysqli_close($conn);
?>
