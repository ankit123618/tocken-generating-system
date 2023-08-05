<?php

session_start();
set_time_limit(10);

$_SESSION = array();
session_destroy();
header("location:../index.php");
