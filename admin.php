<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: adminLogin.php');
   exit;
}
?>  


<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
<div class="container mt-5">
    <h2 class="text-center"><mark>Appointment Booking Details</mark></h2><br>
    <?php
    include_once "conn1.php";
    error_reporting(0);

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM registrations";
    $data = mysqli_query($conn, $query);
    $total = mysqli_num_rows($data);

    if ($total != 0) {
    ?>
    <table class="table table-bordered table-hover" >
        <thead>
            <tr>
                <th>ID</th>
                <th>State</th>
                <th>Name</th>
                <th>Email</th>
                <th>Number</th>
                <th>City</th>
                <th>Service</th>
                <th>Appointment Date</th>
                <th>Operations</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($result = mysqli_fetch_assoc($data)) {
                $aptDate = explode(" ", $result['appointment_date'])[0];
                echo "<tr>
                    <td>" . $result['id'] . "</td>
                    <td>" . $result['state'] . "</td>
                    <td>" . $result['name'] . "</td>
                    <td>" . $result['email'] . "</td>
                    <td>" . $result['number'] . "</td>
                    <td>" . $result['city'] . "</td>
                    <td>" . $result['service'] . "</td>
                    <td>" . $aptDate . "</td>
                    <td>
                        <a href='update.php?id={$result['id']}&service={$result['service']}&dt={$result['appointment_date']}' class='btn btn-primary'>Update</a>
                        <a href='delete.php?id={$result['id']}' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
    <?php
    } else {
        echo "<p class='text-center'>Table has no records...</p>";
    }
    ?>
    <div class="text-center">
        <a href="add.php" class="btn btn-success">Add New</a>
    </div>
</div>
<br>
<br>

<div class="row justify-content-center">
    <div class="col-md-8">
    <?php

$query_contact = "SELECT * FROM contact_submissions";
$data_contact = mysqli_query($conn, $query_contact);
$total_contact = mysqli_num_rows($data_contact);

if ($total_contact != 0) {
    ?>
    <h2 class="text-center"><mark>Contact Form Submissions</mark></h2><br>
    <div class="text-center">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Submission Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($result_contact = mysqli_fetch_assoc($data_contact)) {
                    echo "<tr>
                        <td>" . $result_contact['id'] . "</td>
                        <td>" . $result_contact['name'] . "</td>
                        <td>" . $result_contact['email'] . "</td>
                        <td>" . $result_contact['message'] . "</td>
                        <td>" . $result_contact['submission_date'] . "</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
} else {
    echo "<p class='text-center'>No contact form submissions found...</p>";
}
?>
    </div>
</div>

<br>
<br>

<div class="row justify-content-center">
    <div class="col-md-8">
    <?php

$query_feedback = "SELECT * FROM feedback";
$data_feedback = mysqli_query($conn, $query_feedback);
$total_feedback = mysqli_num_rows($data_feedback);

if ($total_feedback != 0) {
?>
    <h2 class="text-center"><mark>Feedback Data</mark></h2><br>
    <div class="text-center">
        <table class="table table-bordered table-hover table-condensed"> 
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Feedback</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($result_feedback = mysqli_fetch_assoc($data_feedback)) {
                    echo "<tr>
                        <td>" . $result_feedback['id'] . "</td>
                        <td>" . $result_feedback['name'] . "</td>
                        <td>" . $result_feedback['email'] . "</td>
                        <td>" . $result_feedback['feedback'] . "</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
<?php
} else {
    echo "<p class='text-center'>No feedback data found...</p>";
}

?>
    </div>
</div>

<br>
<div class="container mt-5">
        <h2 class="text-center"><mark>Appointment Cancellation/Rescheduling Requests</mark>
        </h2><br>
        <?php
        if(isset($_POST['delete_request'])){
            $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);
            $delete_query = "DELETE FROM appointment_cancellations WHERE id = '$delete_id'";
            if(mysqli_query($conn, $delete_query)){
                echo '<div class="alert alert-success" role="alert">Record deleted successfully!</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error deleting record: ' . mysqli_error($conn) . '</div>';
            }
        }

        $query = "SELECT * FROM appointment_cancellations";
        $data = mysqli_query($conn, $query);

        if (mysqli_num_rows($data) > 0) {
        ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Appointment ID</th>
                    <th>Reason</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($data)) {
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['appointment_id'] . "</td>";
                    echo "<td>" . $row['reason'] . "</td>";
                    echo "<td>";
                    echo '<form method="post" action="">';
                    echo '<input type="hidden" name="delete_id" value="' . $row['id'] . '">';
                    echo '<button type="submit" name="delete_request" class="btn btn-danger btn-sm">Delete</button>';
                    echo '</form>';
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <?php
        } else {
            echo "<p class='text-center'>No cancellation/rescheduling requests found.</p>";
        }
        ?>
    </div>
    <br>

    <div class="container mt-5">
    <?php
    include_once "conn1.php";
    if (isset($_GET['delete_id'])) {
        $deleteID = $_GET['delete_id'];
        
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        $deleteQuery = "DELETE FROM Employee WHERE EmployeeID = $deleteID"; 
    
        if (mysqli_query($conn, $deleteQuery)) {} 
        else {
            echo "Error deleting employee: " . mysqli_error($conn);
        }
    
        $conn->close();
    }
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $query = "SELECT * FROM Employee"; 
    $data = mysqli_query($conn, $query);
    
    ?>
    
    <!DOCTYPE html>
    <html>
    <head>
        <title>Admin Panel - Employee Management</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
    <div class="container mt-5">
        <h2 class="text-center"><mark>Employee Management</mark></h2><br>
        
        <?php
        if (mysqli_num_rows($data) > 0) {
        ?>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($result = mysqli_fetch_assoc($data)) {
                    echo "<tr>
                        <td>" . $result['EmployeeID'] . "</td>
                        <td>" . $result['Name'] . "</td>
                        <td>" . $result['Address'] . "</td>
                        <td>" . $result['Email'] . "</td>
                        <td>" . $result['PhoneNumber'] . "</td>
                        <td>
                            <a href='updateEmployee.php?id={$result['EmployeeID']}' class='btn btn-primary btn-sm'>Update</a>
                            <a href='?delete_id={$result['EmployeeID']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this employee?\");'>Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
        <!-- <br> -->
        <div class="text-center mt-3">
        <a href="addEmployee.php" class="btn btn-success">Add New Employee</a>
        </div>
        <br>
        <?php
        } else {
           echo "<p class='text-center'>No employee records found...</p>";
        }
        ?>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


