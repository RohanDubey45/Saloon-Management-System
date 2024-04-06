<?php
include_once "conn1.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $appointmentId = mysqli_real_escape_string($conn, $_POST['appointmentId']);
    $reason = mysqli_real_escape_string($conn, $_POST['reason']);

    $checkQuery = "SELECT * FROM registrations WHERE id = '$appointmentId' AND email = '$email'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        $insertQuery = "INSERT INTO appointment_cancellations (name, email, appointment_id, reason) VALUES ('$name', '$email', '$appointmentId', '$reason')";

        if (mysqli_query($conn, $insertQuery)) {
            echo "Appointment cancellation/rescheduling request submitted successfully.";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "No such booking record found in the database.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <script>
        // JavaScript function to clear form fields on page load
        function clearForm() {
            document.getElementById("myForm").reset();
        }
        // Call the function when the page is loaded
        window.onload = clearForm;
    </script>
</head>
<body>
    <!-- Your HTML form goes here -->
    <form id="my-form" method="post" action="cancel_appointment.html">
        <!-- Your form fields here -->
    </form>
</body>
</html>
