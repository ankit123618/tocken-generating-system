<!-- 
    THE FILE HERE CONTAINS THE CODE 
    TO INSERT THE INFORMATION PROVIDED
    BY KISAAN TO THE DATABASE

 -->

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('connection.php');

// ARRANGED VARIABLES FOR DATA
$name = $_POST['name'];
$phone = $_POST['phone'];
$sid = $_POST['sid'];
$bahi = $_POST['bahi'];
$rakva = $_POST['rakva'];
$tahseel = $_POST['tahseel'];
$vitrank = $_POST['vitrank'];

// INSERTING KISAAN DATA INTO DATABASE
$insert = "INSERT INTO `kisaan` (`name`, `samagra`, `bahi`, `phone`, `rakva`, `tahseel`, `vitrankendra`) VALUES ('$name', $sid, $bahi, $phone, $rakva, '$tahseel', '$vitrank')";
$status = mysqli_query($connection, $insert);

if ($status == 1) {
    // FETCHING MESSAGE TO SHOW TO THE KISAAN
    $select = "select message from messages where id = 2";
    $result = mysqli_query($connection, $select);
    $message = mysqli_fetch_array($result);
    echo $message['message'];
}
