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
$status = $data['kisaanstatus'];
$token = $data['kisaantn'];
$name = $data["kisaanname"];
$phone = $data["kisaanphone"];
$tahseel = $data["kisaantahseel"];
$vitrank = $data["kisaanvitrankendra"];
$rakva = $data["kisaanrakva"];
$samagra = $data["kisaansamagra"];
$bahi = $data["kisaanbahi"];
$date = $data["kisaandate"];

// CODE WHICH ALOCATE DATE AND TIME WITH TOKEN TO THE KISAAN
$currentDate = new DateTime();
$dbDateObject = DateTime::createFromFormat("Y-m-d", $date);
// var_dump($dbDateObject);
$nextDate = $dbDateObject->add(new DateInterval('P1D'));
$da = $nextDate->format('Y-m-d');

$select = "select date from kisaan where date = '$date'";
$result = mysqli_query($connection,$select);
$data = mysqli_fetch_all($result);

if(count($data) <= 20)
    $ta = '10 - 11';
elseif (count($data) <= 40 && count($data) > 20) {
    $ta = '11 - 12';
}
elseif (count($data) <= 60 && count($data) > 40) {
    $ta = '12 - 1';
}
elseif (count($data) <= 80 && count($data) > 60) {
    $ta = '2 - 3';
}
elseif (count($data) <= 100 && count($data) > 80) {
    $ta = '11 - 12';
}
elseif (count($data) <= 120 && count($data) > 100) {
    $ta = '3 - 4';
}
elseif (count($data) <= 140 && count($data) > 120) {
    $ta = '4 - 5';
}








// echo $name;
// Perform further processing with the data...
$update =  "UPDATE `kisaan` SET `name`='$name',`samagra`=$samagra,`bahi`=$bahi,`phone`=$phone,`rakva`='$rakva',`tahseel`='$tahseel',`vitrankendra`='$vitrank', `status`='$status',`datealloted`='$da', `timealloted`='$ta' WHERE `token`= $token";

// FETCHING THE MESSAGE FROM DATABASE FOR TOKEN ALLOCATION
$select = "select message from messages where id = 1";
$result = mysqli_query($connection,$select);

$row = mysqli_fetch_array($result);
$message = $row['message'];

$orgmssg = str_replace(array('@name','@tn','@time','@vitrank','@date'),array($name,$token,$ta,$vitrank,$da),$message);

#INSERTING MESSAGE TO DATABASE
$insert_mssg = "update kisaan set message = '$orgmssg' where token = $token";

if(mysqli_query($connection,$update) && mysqli_query($connection,$insert_mssg))  
    echo "$orgmssg";
else {

    echo "bad";
    echo "Error: " . mysqli_error($connection);

} 

?>