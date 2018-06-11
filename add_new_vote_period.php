<?php
include './config/database.php';

$id = mysqli_real_escape_string($link, $_POST['id']);
$period = mysqli_real_escape_string($link, $_POST['period']);
$start_time = mysqli_real_escape_string($link, $_POST['start_time']);
$end_time = mysqli_real_escape_string($link, $_POST['end_time']);

$query_update = "UPDATE election_period SET `period` = '{$period}', start_time = '{$start_time}', end_time = '{$end_time}' WHERE id = {$id}";
$result_update = mysqli_query($link, $query_update) or die(mysqli_error($link));

if($result_update){
    header("Location: settings.php");
} else {
    header("Location: settings.php");
}

?>

