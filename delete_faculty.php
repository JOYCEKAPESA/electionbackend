<?php

include './config/database.php';

$id = mysqli_real_escape_string($link, $_GET['id']);

$params = array($id);

if (isset($id) && !empty($id)) {
    $query_delete_faculty = "DELETE FROM faculties WHERE id = {$id}";

    $result_delete_faculty = mysqli_query($link, $query_delete_faculty) or die(mysqli_error($link));

    if ($result_delete_faculty) {
        //Deleted
        header("Location: faculty.php");
    } else {
        //Failed
        header("Location: faculty.php");
    }
}
?>

