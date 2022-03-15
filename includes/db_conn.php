<?php
    //Server Ip
    $server = "127.0.0.1";

    //User that has access to the database
    $user= "root";

    //Password used by the user
    $password = 'banana';

    //Which database it will try and access
    $db = "db_market";

    //Variable that will hold the connection to the database if there was success
    $conn = mysqli_connect($server,$user,$password,$db);

    //If there was a error trying to connect it will kill the connection
    if ($conn->connect_error)
        die(mysqli_error($conn));

?>