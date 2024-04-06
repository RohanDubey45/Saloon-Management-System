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
session_start(); 

include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"]; 
    $password = $_POST["password"];

    $sql = "SELECT * FROM signing WHERE email='$username'";
    $result = $conn->query($sql);

    

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["user_id"] = $row["id"]; 
            
            $_SESSION['user_name'] = $username;

            header("Location: index.php");
            exit(); 
        } else {
            echo "<script>alert('Wrong password! Please enter correct password.'); window.location.href = 'index3.html';</script>";
            exit(); 
        }
    } else {
        echo "User not found.";
        header("Location: index3.html");
        exit();
    }
}

$conn->close();
?>
