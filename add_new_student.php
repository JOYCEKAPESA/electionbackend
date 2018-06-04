<?php

include './config/database.php';

$reg_number = mysqli_real_escape_string($link, $_POST['reg_number']);
$first_name = mysqli_real_escape_string($link, $_POST['first_name']);
$last_name = mysqli_real_escape_string($link, $_POST['last_name']);
$faculty_name = mysqli_real_escape_string($link, $_POST['faculty_name']);
$batch_name = mysqli_real_escape_string($link, $_POST['batch_name']);


$result_update_student = mysqli_query($link, $query_update_student) or die(mysqli_error($link));

if ($result_update_student) {
    //updated successfully
    header('Location: students.php');
} else {
    //Error
    header('Location: students.php');
}
