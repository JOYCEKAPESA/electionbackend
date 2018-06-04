<?php

include './config/database.php';

$course_name = mysqli_real_escape_string($link, $_POST['course_name']);
$years_to_complete = mysqli_real_escape_string($link, $_POST['years_to_complete']);
$faculty_name = mysqli_real_escape_string($link, $_POST['faculty_name']);

$query_update_course = "INSERT INTO courses (course_name) VALUES ('{$course_name}')";
$query_update_course = "INSERT INTO courses (faculty_name) VALUES ('{$faculty_id}')";
$query_update_course = "INSERT INTO courses (years_to_complete) VALUES ('{$years_to_complete}')";
$result_update_course = mysqli_query($link, $query_update_course) or die(mysqli_error($link));

if ($result_update_course) {
    //updated successfully
    header('Location: courses.php');
} else {
    //Error
    header('Location: courses.php');
}
