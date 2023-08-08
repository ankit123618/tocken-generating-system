<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$currentDate = new DateTime();
echo $currentDate;
$dbDateObject = DateTime::createFromFormat("Y-m-d", '2023-07-09');
var_dump($dbDateObject);
$nextDate = $dbDateObject->add(new DateInterval('P1D'));
var_dump($nextDate);
$da = $nextDate->format('Y-m-d');
echo $da;

?>