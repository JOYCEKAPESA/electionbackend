<?php

include './config/database.php';

$id = mysqli_real_escape_string($link, $_POST['id']);
$batch_name = mysqli_real_escape_string($link, $_POST['batch_name']);
$course_name = mysqli_real_escape_string($link, $_POST['course_name']);

$query_update_batch = "UPDATE batches SET batch_name = '{$batch_name}', course_name = '{$course_name}' WHERE id = {$id}";
$result_update_batch = mysqli_query($link, $query_update_batch) or die(mysqli_error($link));

if ($result_update_batch) {
    //updated successfully
    header('Location: view_batches.php?id=' . $id);
} else {
    //Error
    header('Location: view_batches.php?id=' . $id);
}