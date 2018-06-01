<?php

include './config/database.php';

$id = mysqli_real_escape_string($link, $_GET['id']);

$params = array($id);

if (isset($id) && !empty($id)) {
    $query_delete_batches = "DELETE FROM batches WHERE id = {$batch_id}";

    $result_delete_batches = mysqli_query($link, $query_delete_batches) or die(mysqli_error($link));

    if ($result_delete_batches) {
        //Deleted
        header("Location: batches.php");
    } else {
        //Failed
        header("Location: batches.php");
    }
}
?>

