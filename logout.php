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
session_unset();
session_destroy();

echo "you have been loged out..";
header('location:index3.html');
?>