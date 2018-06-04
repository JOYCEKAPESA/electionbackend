<?php

include './config/database.php';

$batch_name = mysqli_real_escape_string($link, $_POST['batch_name']);
$course_name = mysqli_real_escape_string($link, $_POST['course_name']);

$query_update_batch = "INSERT INTO batches (batch_name) VALUES ('{$batch_name}')";
$query_update_batch = "INSERT INTO batches (course_name) VALUES ('{$course_name}')";
$result_update_batch = mysqli_query($link, $query_update_batch) or die(mysqli_error($link));

if ($result_update_batch) {
    //updated successfully
    header('Location: batches.php');
} else {
    //Error
    header('Location: batches.php');
}
