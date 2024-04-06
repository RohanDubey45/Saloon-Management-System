<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: adminLogin.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Customer Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Update Customer details</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form id="appointment-form" action="#" method="POST">
                <div class="form-group">
                    <label for="state">State:</label>
                    <select class="form-control" id="State" name="state" required>
                        <option value="Maharashtra" selected>Maharashtra</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $result['name']; ?>" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $result['email']; ?>" placeholder="Email" title="Please enter a valid email." required>
                </div>
                <div class="form-group">
                    <label for="number">Number:</label>
                    <input type="tel" class="form-control" id="Number" name="number" value="<?php echo $result['number']; ?>" placeholder="Number" pattern="[0-9]{10}" title="Please enter a valid 10-digit phone number." required>
                </div>
                <div class="form-group">
                    <label for="city">City:</label>
                    <select class="form-control" id="City" name="city" required>
                        <option value="Kalyan" selected>Kalyan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="service">Service:</label>
                    <select class="form-control" name="service" required>
                        <option value="">Select Service</option>
                        <option value="Haircut" <?php if($result['service'] == 'Haircut') { echo "selected"; } ?>>Haircut</option>
                        <option value="Shaving" <?php if($result['service'] == 'Shaving') { echo "selected"; } ?>>Shaving</option>
                        <option value="Face Massage" <?php if($result['service'] == 'Face Massage') { echo "selected"; } ?>>Face Massage</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" class="form-control" id="date" name="date" value="<?php echo date('Y-m-d', strtotime($result['appointment_date'])); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary" name="update">Submit</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

