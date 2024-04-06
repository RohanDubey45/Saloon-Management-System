<?php

    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'admin';

    $conn = mysqli_connect($hostname, $username, $password, $dbname);

    echo ($conn) ? 'Connected!' : 'Unsuccessful!!';

?>