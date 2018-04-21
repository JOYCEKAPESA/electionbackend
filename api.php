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

    case 'vote_sheet':
        //Generating a list of candidates so one can vote
        $query_vote_sheet = "SELECT c.id AS candId, first_name, last_name, position_name
                               FROM candidates c
                         INNER JOIN positions p
                                 ON p.id = c.position_id
                         INNER JOIN students s 
                                 ON s.id = c.student_id";

        $result_vote_sheet = mysqli_query($link, $query_vote_sheet) or die(mysqli_error($link));

        while ($row = mysqli_fetch_array($result_vote_sheet)) {
            $candidates[$row['position_name']][] = array(
                "full_name" => $row['first_name'] . " " . $row['last_name'],
                "candidate_id" => $row["candId"]
            );
        }

        echo json_encode($candidates); // Creating json response for voting sheet
        break;

    case 'cast_votes':

        //Cast votes

        $selectedPresident = $_GET['Presidents'];
        $sselectedSenetor = $_GET['Senators'];
        $selectedFr = $_GET['Faculty_Representatives'];

//        print_r($_GET);

        foreach ($_GET as $candidate_id) { //since number of votes which can be casted is dynamic so we have to loop na hizo id za candidates tunazipata kwenye hiyo for loop
            if ($candidate_id !== 'cast_votes') {

                //Get position id from provided candidate id
                $query_get_candidate = "SELECT position_id
                                          FROM candidates
                                         WHERE id = {$candidate_id}
                                         LIMIT 1";

                $result_get_candidate = mysqli_query($link, $query_get_candidate) or die(mysqli_error($link));

                if (mysqli_num_rows($result_get_candidate) == 1) {
                    $row = mysqli_fetch_array($result_get_candidate);
                    $position_id = $row['position_id'];

                    //CAST A VOTE
                    $query_cast_vote = "INSERT INTO votes
                                                 (user_id, positon_id, election_period_id, candidate_id)
                                          VALUES (5, '{$position_id}', 1, '{$candidate_id}')";

                    $result_cast_vote = mysqli_query($link, $query_cast_vote) or die(mysqli_error($link));

                    if ($result_cast_vote) {

                        //Votes casted succefully 
                        $response = array(
                            'cast_status' => 'success'
                        );
                    } else {
                        //Can't cast vots
                        $response = array(
                            'cast_status' => 'failed'
                        );
                    }
                }
            }
        }

        echo json_encode($response);

        break;
}
?>


