<?php

include './config/database.php';

$username = mysqli_real_escape_string($link, $_POST['username']);
$password = mysqli_real_escape_string($link, $_POST['password']);

$query_update_user = "INSERT INTO users (course_name) VALUES ('{$username}')";
$query_update_user = "INSERT INTO users (faculty_name) VALUES ('{$password}')";
$result_update_user = mysqli_query($link, $query_update_user) or die(mysqli_error($link));

if ($result_update_user) {
    //updated successfully
    header('Location: users.php');
} else {
    //Error
    header('Location: users.php');
}
