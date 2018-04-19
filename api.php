<?php

include './config/database.php';

@$action = $_GET['action']; //Get action form url

switch ($action) {
    case 'login':

        @$username = $_GET['username']; //Get username from url (Don't trust user inputs security will be implemented later)
        @$password = $_GET['password']; //Get password from url

        $query_authenticate = "SELECT username, password 
                         FROM users
                         WHERE username = '{$username}'
                           AND password = '{$password}'
                         LIMIT 1";

        $query_result_authenticate = mysqli_query($link, $query_authenticate) or die(mysqli_error($link));

        if (mysqli_num_rows($query_result_authenticate) == 1) {
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
        break;

    case 'vote':
        //Generating a list of candidates so one can vote
        $query_vote_sheet = "SELECT first_name, last_name, position_name
                               FROM candidates c
                         INNER JOIN positions p
                                 ON p.id = c.position_id
                         INNER JOIN students s 
                                 ON s.id = c.student_id"; 

        $result_vote_sheet = mysqli_query($link, $query_vote_sheet) or die(mysqli_error($link));

        while ($row = mysqli_fetch_array($result_vote_sheet)) {
            $candidates[$row['position_name']][] = $row['first_name'] . " " . $row['last_name']; //Dynamically creating associative array
        }

        echo json_encode($candidates); // Creating json response for voting sheet
        break;
       
}
?>


