<?php

include './config/database.php';

$id = mysqli_real_escape_string($link, $_POST['id']);
$course_name = mysqli_real_escape_string($link, $_POST['course_name']);
$years_to_complete = mysqli_real_escape_string($link, $_POST['years_to_complete']);

$query_update_course = "UPDATE courses SET course_name = '{$course_name}', years_to_complete = '{$years_to_complete}' WHERE id = {$id}";
$result_update_course = mysqli_query($link, $query_update_course) or die(mysqli_error($link));

if ($result_update_course) {
    //updated successfully
    header('Location: view_course.php?id=' . $id);
} else {
    //Error
    header('Location: view_course.php?id=' . $id);
}