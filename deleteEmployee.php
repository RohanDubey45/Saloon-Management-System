<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: adminLogin.php');
    exit;
}
?>
<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: adminLogin.php');
    exit;
}

include_once "conn1.php"; 

if (isset($_GET['id'])) {
    $employeeID = $_GET['id'];
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $deleteQuery = "DELETE FROM employee WHERE EmployeeID = $employeeID"; 

    if (mysqli_query($conn, $deleteQuery)) {
        header('Location: admin.php');
        exit;
    } else {
        echo "Error deleting employee: " . mysqli_error($conn);
    }

    $conn->close();
} else {
    echo "Employee ID not provided.";
    exit;
}
?>
