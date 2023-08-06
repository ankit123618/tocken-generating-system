<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$currentDate = new DateTime();
var_dump($currentDate);
echo $currentDate;
$format =$currentDate->format("d-m-y");
var_dump($format);

?>