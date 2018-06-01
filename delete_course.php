<?php

include './config/database.php';

$id = mysqli_real_escape_string($link, $_GET['id']);

$params = array($id);

if (isset($id) && !empty($id)) {
    $query_delete_course = "DELETE FROM courses WHERE id = {$id}";

    $result_delete_course = mysqli_query($link, $query_delete_course) or die(mysqli_error($link));

    if ($result_delete_course) {
        //Deleted
        header("Location: courses.php");
    } else {
        //Failed
        header("Location: courses.php");
    }
}
?>

