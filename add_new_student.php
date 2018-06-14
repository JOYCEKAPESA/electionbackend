<?php

include './config/database.php';
$reg_number = mysqli_real_escape_string($link, $_POST['registration_no']);
$first_name = mysqli_real_escape_string($link, $_POST['first_name']);
$last_name = mysqli_real_escape_string($link, $_POST['last_name']);
$faculty = mysqli_real_escape_string($link, $_POST['faculty']);
$course = mysqli_real_escape_string($link, $_POST['course']);
$batch = mysqli_real_escape_string($link, $_POST['batch']);

$hashed_password = sha1("last_name"); //default student password
$query_user = "INSERT INTO users (username, password) VALUES ('$reg_number', '$hashed_password')";
$result_user = mysqli_query($link, $query_user) or die(mysqli_error($link));

//Grab user inserted id
$user_id = mysqli_insert_id($link);

$query_add_user = "INSERT INTO students  
    (reg_number, first_name, last_name, faculty_id, course_id, batch_id, user_id)
     VALUES ('$reg_number', '$first_name', '$last_name', '$faculty','$course', '$batch', '$user_id')";

$result_update_student = mysqli_query($link, $query_add_user) or die(mysqli_error($link));

if ($result_update_student) {
    //updated successfully
    header('Location: students.php');
} else {
    //Error
    header('Location: students.php');
}
