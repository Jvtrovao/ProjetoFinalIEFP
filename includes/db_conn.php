<?php
    $server = "127.0.0.1";
    $user= "root";
    $password = '';
    $db = "db_market";

    $conn = mysqli_connect($server,$user,$password,$db);

    if ($conn->connect_error)
        die(mysqli_error($conn));

?>