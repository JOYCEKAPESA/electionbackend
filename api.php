<?php

include './config/database.php';

@$action = $_GET['action']; //Get action form url

switch ($action) {
    case 'login':

        @$username = $_GET['username']; //Get username from url (Don't trust user inputs security will be implemented later)
        @$password = $_GET['password']; //Get password from url
        $hashedPassword = sha1($password);

        $query_authenticate = "SELECT u.id, faculty_id, course_id, batch_id, username, password 
                         FROM users u
                   INNER JOIN students s
                           ON u.id = s.user_id
                        WHERE username = '{$username}'
                          AND password = '{$hashedPassword}'
                         LIMIT 1";

        $query_result_authenticate = mysqli_query($link, $query_authenticate) or die(mysqli_error($link));
        $row = mysqli_fetch_array($query_result_authenticate);

        if (mysqli_num_rows($query_result_authenticate) == 1) {
            //Username and password is valid  
            $response = array(
                'login_status' => 'success',
                'user_id' => $row['id'],
                'faculty_id' => $row['faculty_id'],
                'course_id' => $row['course_id'],
                'batch_id' => $row['batch_id']
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
        $faculty_id = $_GET['faculty_id'];
        $course_id = $_GET['course_id'];
        $batch_id = $_GET['batch_id'];
        //Generating a list of candidates so one can vote
        $query_vote_sheet = "SELECT c.id AS candId, first_name, last_name, position_name, c.faculty_id, c.course_id, c.batch_id
                               FROM candidates c
                         INNER JOIN positions p
                                 ON p.id = c.position_id
                         INNER JOIN students s 
                                 ON s.id = c.student_id
                              WHERE (c.faculty_id = {$faculty_id} OR c.faculty_id IS NULL)
                                AND (c.course_id = {$course_id} OR c.course_id IS NULL)
                                AND (c.batch_id = {$batch_id} OR c.batch_id IS NULL)";

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

//        $selectedPresident = $_GET['Presidents'];
//        $sselectedSenetor = $_GET['Senators'];
//        $selectedFr = $_GET['Faculty_Representatives'];
        
        $user_id = $_GET['user_id'];
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
                                          VALUES ({$user_id}, '{$position_id}', 1, '{$candidate_id}')";

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


