<?php

include './config/database.php';

$student_id = mysqli_real_escape_string($link, $_GET['student_id']);

$params = array($student_id);

if (isset($student_id) && !empty($student_id)) {
    $query_delete_student = "DELETE FROM students WHERE id = {$student_id}";

    $result_delete_student = mysqli_query($link, $query_delete_student) or die(mysqli_error($link));

    if ($result_delete_student) {
        //Deleted
        header("Location: students.php");
    } else {
        //Failed
        header("Location: students.php");
    }
}
?>

