<?php

include './config/database.php';

$id = mysqli_real_escape_string($link, $_POST['id']);
$reg_number = mysqli_real_escape_string($link, $_POST['reg_number']);
$first_name = mysqli_real_escape_string($link, $_POST['first_name']);
$last_name = mysqli_real_escape_string($link, $_POST['last_name']);
$faculty_name = mysqli_real_escape_string($link, $_POST['faculty_name']);
$batch_name = mysqli_real_escape_string($link, $_POST['batch_name']);

$query_update_student = "UPDATE students SET reg_number = '{$reg_number}', firstname = '{$first_name}', last_name='{$last_name}',faculty_name = '{$faculty_name}', batch_name = '{$batch_name}' WHERE id = {$id}";
$result_update_student = mysqli_query($link, $query_update_student) or die(mysqli_error($link));

if ($result_update_student) {
    //updated successfully
    header('Location: view_students.php?id=' . $id);
} else {
    //Error
    header('Location: view_students.php?id=' . $id);
}