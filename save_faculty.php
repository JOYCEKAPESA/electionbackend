<?php

include './config/database.php';

$id = mysqli_real_escape_string($link, $_POST['id']);
$faculty_name = mysqli_real_escape_string($link, $_POST['faculty_name']);

$query_update_faculty = "UPDATE faculties SET faculty_name = '{$faculty_name}' WHERE id = {$id}";
$result_update_faculty = mysqli_query($link, $query_update_faculty) or die(mysqli_error($link));

if ($result_update_faculty) {
    //updated successfully
    header('Location: view_faculty.php?id=' . $id);
} else {
    //Error
    header('Location: view_faculty.php?id=' . $id);
}