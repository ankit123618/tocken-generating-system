<?php

require_once('connection.php');
// echo $connection;
session_start();


    // arranged variables for value
    $username = $_POST['user-name'];
    $password = $_POST['password'];
   

    $select = "select * from admin where username = '$username' && password = '$password'";
    $result = mysqli_query($connection,$select);
 
    $num = mysqli_num_rows($result);
    
    if($num == 1)
    {
        $_SESSION['username'] = $username;
        echo "good";
    }
    else{
        echo "bad";
    }


?>