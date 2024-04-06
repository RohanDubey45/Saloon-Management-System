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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
          body {
        background-image: url(wallpaperflare.com_wallpaper.jpg); 
        background-size: cover; 
        background-repeat: no-repeat; 
        background-attachment: fixed; 
        color: aliceblue;

    }
    
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center text-primary">Feedback Form</h2>
        <form action="feedbackdata.php" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" pattern="[A-Za-z ]+" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="feedback">Feedback:</label>
                <textarea class="form-control" id="feedback" name="feedback" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-success btn-block">Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
  
</body>
</html>



