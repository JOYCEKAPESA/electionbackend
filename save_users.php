<?php

include './config/database.php';

$id = mysqli_real_escape_string($link, $_POST['id']);
$username = mysqli_real_escape_string($link, $_POST['username']);
$password = mysqli_real_escape_string($link, $_POST['password']);

$query_update_user = "UPDATE users SET username = '{$username}', password = '{$password}' WHERE id = {$id}";
$result_update_user = mysqli_query($link, $query_update_user) or die(mysqli_error($link));

if ($result_update_user) {
    //updated successfully
    header('Location: view_users.php?id=' . $id);
} else {
    //Error
    header('Location: view_users.php?id=' . $id);
}