<?php

$host = 'localhost';
$user = 'root';
$password = '';
$database = "election";

$link = mysqli_connect($host, $user, $password, $database) or die("Cannot connect to db"); //Connect to database
$db = mysqli_select_db($link, $database) or die(mysqli_error($link));

