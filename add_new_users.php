<?php

include './config/database.php';

$username = mysqli_real_escape_string($link, $_POST['username']);
$password = mysqli_real_escape_string($link, $_POST['password']);

$password = sha1($password); //Hashing user password

$query_user = "INSERT INTO users (username, password) VALUES ('{$username}', '{$password}')";
$result_user = mysqli_query($link, $query_user) or die(mysqli_error($link));

if ($result_update_user) {
    //updated successfully
    header('Location: users.php');
} else {
    //Error
    header('Location: users.php');
}




