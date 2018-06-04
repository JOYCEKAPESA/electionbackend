<?php

include './config/database.php';

$faculty_name = mysqli_real_escape_string($link, $_POST['faculty_name']);

$query_update_faculty = "INSERT INTO faculties (faculty_name) VALUES ('{$faculty_name}')";
$result_update_faculty = mysqli_query($link, $query_update_faculty) or die(mysqli_error($link));

if ($result_update_faculty) {
    //updated successfully
    header('Location: faculty.php');
} else {
    //Error
    header('Location: faculty.php');
}
