<!DOCTYPE html>
<html>
<head>
    <title>Add New Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center"><mark>Add New Record</mark></h2>
    <?php
    $servername = "localhost";
    $username = "root";  
    $password = "";      
    $dbname = "admin";
    
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $state = $_POST['state'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $city = $_POST['city'];
        $service = $_POST['service'];
        $date = $_POST['date'];

        // insert
        $query = "INSERT INTO registrations (state, name, email, number, city, service, appointment_date)
                  VALUES ('$state', '$name', '$email', '$number', '$city', '$service', '$date')";

        if ($conn->query($query) === TRUE) {
            echo "<div class='alert alert-success'>Record added successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $query . "<br>" . $conn->error . "</div>";
        }
    }
    ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="state">State:</label>
            <select class="form-control" id="state" name="state" required>
                <option value="" disabled selected>Select State</option>
                <option value="Maharashtra">Maharashtra</option>
            </select>
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" pattern="[A-Za-z ]+" title="Name should contain only alphabetic characters"required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="number">Number:</label>
            <input type="tel" class="form-control" id="number" name="number" pattern="[0-9]{10}" title="Please enter a valid 10-digit phone number." required>
        </div>
        <div class="form-group">
            <label for="city">City:</label>
            <select class="form-control" id="city" name="city" required>
                <option value="" disabled selected>Select City</option>
                <option value="Kalyan">Kalyan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="service">Service:</label>
            <select class="form-control" id="service" name="service" required>
                <option value="" disabled selected>Select Service</option>
                <option value="Haircut">Haircut</option>
                <option value="Shaving">Shaving</option>
                <option value="Face Massage">Face Massage</option>
            </select>
        </div>
        <div class="form-group">
            <label for="date">Appointment Date:</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
