<!-- THIS FILE CONTAINS THE CODE 
    FOR VERIFIED, UNVERIFIED AND DELETE USERS
-->


<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('connection.php');

session_start();

// var_dump($_POST);
$data = $_POST;



// Now you can access the data as a PHP array
$status = $data['buttonid'];
$token = $data['kisaantn'];
$name = $data["kisaanname"];
$phone = $data["kisaanphone"];
$tahseel = $data["kisaantahseel"];
$vitrank = $data["kisaanvitrankendra"];
$rakva = $data["kisaanrakva"];
$samagra = $data["kisaansamagra"];
$bahi = $data["kisaanbahi"];
$date = $data["kisaandate"];
// $ta = $data["kisaanta"];
// $da = $data["kisaanda"];



// CODE WHICH ALOCATE DATE AND TIME WITH TOKEN TO THE KISAAN
$currentDate = new DateTime();
$dbDateObject = DateTime::createFromFormat("Y-m-d", $date);
// var_dump($dbDateObject);
$nextDate = $dbDateObject->add(new DateInterval('P1D'));
$da = $nextDate->format('Y-m-d');






// echo $name;
// Perform further processing with the data...
$update =  "UPDATE `kisaan` SET `name`='$name',`samagra`=$samagra,`bahi`=$bahi,`phone`=$phone,`rakva`='$rakva',`tahseel`='$tahseel',`vitrankendra`='$vitrank', `status`='$status',`datealloted`='$da', `timealloted`=null WHERE `token`= $token";

// FETCHING THE MESSAGE FROM DATABASE FOR TOKEN ALLOCATION
$select = "select message from messages where id = 1";
$result = mysqli_query($connection,$select);

$row = mysqli_fetch_array($result);
$message = $row['message'];

$orgmssg = str_replace(array('@name','@tn','@time','@vitrank','@date'),array($name,$token,'----',$vitrank,$da),$message);
if(mysqli_query($connection,$update))  
    echo "$orgmssg";
else {

    echo "bad";
    echo "Error: " . mysqli_error($connection);

} 

?>