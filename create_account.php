<?php
session_start();
// echo "Welcome ".$_SESSION['user_name'];
$User_Profile = $_SESSION['user_name'];
if($User_Profile == true){

}
else{
    header('location:index3.html');
}

?>
<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "create") {
    // var_dump($_POST);
    $email = $_POST["newEmail"];
    $password = $_POST["newPassword"];
    $confirmPassword = $_POST["confirmPassword"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
        exit();
    }

    $checkEmailQuery = "SELECT * FROM signing WHERE email='$email'";
    $result = $conn->query($checkEmailQuery);
    if ($result->num_rows > 0) {
        echo "This email is already registered with an account. Please use a different email.";
        exit();
    }

    if (!validatePassword($password)) {
        echo "Invalid password. It must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one digit, and one special character.";
        exit();
    }

    if (!validatePassword($password)) {
        echo "Invalid password. It must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one digit, and one special character.";
        exit();
    }

    if ($password !== $confirmPassword) {
        echo "Password and confirm password do not match, try again...";
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 

    $sql = "INSERT INTO signing (email, password) VALUES ('$email', '$hashedPassword')";

    if ($conn->query($sql) === true) {
        header("Location: index3.html?registration=success");
        exit(); 
    } else {
        echo "Error creating account: " . $conn->error;
    }
}

function validatePassword($password) {
    if (strlen($password) < 8) {
        return false;
    }

    if (!preg_match('/[A-Z]/', $password)) {
        return false;
    }

    if (!preg_match('/[a-z]/', $password)) {
        return false;
    }

    if (!preg_match('/[0-9]/', $password)) {
        return false;
    }

    if (!preg_match('/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/', $password)) {
        return false;
    }

    return true;
}

$conn->close();
?>
