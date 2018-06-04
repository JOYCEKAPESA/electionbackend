<?php

include './config/database.php';

$id = mysqli_real_escape_string($link, $_POST['id']);
$course_name = mysqli_real_escape_string($link, $_POST['course_name']);
$years_to_complete = mysqli_real_escape_string($link, $_POST['years_to_complete']);

$query_update_candidates = "UPDATE candidates SET course_name = '{$course_name}', years_to_complete = '{$years_to_complete}' WHERE id = {$id}";
$result_update_candidates = mysqli_query($link, $query_update_course) or die(mysqli_error($link));

if ($result_update_candidates) {
    //updated successfully
    header('Location: view_candidates.php?id=' . $id);
} else {
    //Error
    header('Location: view_candidates.php?id=' . $id);
}