<?php

include './config/database.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query_login = "SELECT username
                  FROM users 
                 WHERE username = '{$username}'
                   AND password = '{$password}'
                 LIMIT 1";

$result_login = mysqli_query($link, $query_login) or die(mysqli_error($link));

if (mysqli_num_rows($result_login)) {
    echo "user logged in";
    header('Location: dashboard.php');
} else {
    echo "failed to login";
}



