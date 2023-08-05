<?php

require_once('connection.php');

session_start();


    // arranged variables for value
    $username = $_POST['oname'];
    $password = $_POST['password'];
    

    $select = "select * from operator where name = '$username' && password = '$password'";
    $result = mysqli_query($connection,$select);
    $num = mysqli_num_rows($result);

    if($num == 1)
    {
        $_SESSION['username'] = $username;
        echo 1;
    }
    else{
        
        echo "bad";
    }

    

?>