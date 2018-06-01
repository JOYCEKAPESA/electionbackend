<?php

include './config/database.php';

$user_id = mysqli_real_escape_string($link, $_GET['user_id']);

$params = array($user_id);

if (isset($user_id) && !empty($user_id)) {
    $query_delete_user = "DELETE FROM users WHERE id = {$user_id}";

    $result_delete_user = mysqli_query($link, $query_delete_user) or die(mysqli_error($link));

    if ($result_delete_user) {
        //Deleted
        header("Location: users.php");
    } else {
        //Failed
        header("Location: users.php");
    }
}
?>

