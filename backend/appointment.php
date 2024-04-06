<?php
include_once "./config.php";
include('../smtp/PHPMailerAutoload.php');

function smtp_mailer($to, $subject, $msg)
{
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    //$mail->SMTPDebug = 2;
    $mail->Username = "CrystalSaloon45@gmail.com";
    $mail->Password = "gkkdrmxdwdicsfaw";
    $mail->SetFrom("CrystalSaloon45@gmail.com");
    $mail->Subject = $subject;
    $mail->Body = $msg;
    $mail->AddAddress($to);
    $mail->SMTPOptions = array('ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => false
    ));
    if (!$mail->Send()) {
        echo $mail->ErrorInfo;
    } else {
        return 'Sent';
    }
}

$state = mysqli_real_escape_string($conn, $_POST['state']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$number = mysqli_real_escape_string($conn, $_POST['number']);
$city = mysqli_real_escape_string($conn, $_POST['city']);
$service = mysqli_real_escape_string($conn, $_POST['service']);
$date = mysqli_real_escape_string($conn, $_POST['date']);

// insert
$query = mysqli_query($conn, "INSERT INTO registrations (state, name, email, number, city, service, appointment_date) VALUES('{$state}', '{$name}', '{$email}', '{$number}', '{$city}','{$service}', '{$date}')");

if ($query) {
    $id = mysqli_insert_id($conn);

    $msg = "Hello, {$name}! \n\n Your appointment is booked successfully for the date '{$date}' and your appointment ID is {$id}! If you have any questions or need to reschedule the appointment, please contact us. Thank you!";

    smtp_mailer($email, 'Appointment!', $msg);

    echo "Appointment booked successfully. Your appointment ID is {$id}<br>{$msg}";
} else {
    echo 'Something went wrong!';
}
?>
