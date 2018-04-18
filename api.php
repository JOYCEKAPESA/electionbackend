<?php

include './config/database.php';

@$action = $_GET['action']; //Get action form url
@$username = $_GET['username']; //Get username from url (Don't trust user inputs security will be implemented later)
@$password = $_GET['password']; //Get password from url

$query_authenticate = "SELECT username, password 
                         FROM users
                         WHERE username = '{$username}'
                           AND password = '{$password}'
                         LIMIT 1"; 
                           
$query_result_authenticate = mysqli_query($link, $query_authenticate) or die(mysqli_error($link));

if(mysqli_num_rows($query_result_authenticate) == 1){
//Username and password is valid  
    $response = array(
        'login_status' => 'success'
    );
} else {
    //Invalid username or password
    $response = array(
        'login_status' => 'failed'
    );
}

echo json_encode($response); // echo login status

?>


