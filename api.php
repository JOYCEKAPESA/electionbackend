<?php

date_default_timezone_set("Africa/Nairobi");
include './config/database.php';

@$action = $_GET['action']; //Get action form url

switch ($action) {
    case 'login':

        @$username = $_GET['username']; //Get username from url (Don't trust user inputs security will be implemented later)
        @$password = $_GET['password']; //Get password from url
        $hashedPassword = sha1($password);

        $query_authenticate = "SELECT u.id, faculty_id, course_id, batch_id, username, password, is_first_time_login
                         FROM users u
                   INNER JOIN students s
                           ON u.id = s.user_id
                        WHERE username = '{$username}'
                          AND password = '{$hashedPassword}'
                         LIMIT 1";

        $query_result_authenticate = mysqli_query($link, $query_authenticate) or die(mysqli_error($link));
        $row = mysqli_fetch_array($query_result_authenticate);

        $flogin = $row['is_first_time_login'] == 1 ? TRUE : FALSE;

        if (mysqli_num_rows($query_result_authenticate) == 1) {
            //Username and password is valid  
            $response = array(
                'login_status' => 'success',
                'user_id' => $row['id'],
                'faculty_id' => $row['faculty_id'],
                'batch_id' => $row['batch_id'],
                'is_first_time_login' => $flogin
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
//        $course_id = $_GET['course_id'];
        $batch_id = $_GET['batch_id'];
        $user_id = $_GET['user_id'];

        $now = date("Y-m-d H:i:s");

        //Check if election period has ended
        $query_election_period = "SELECT * FROM election_period WHERE '{$now}' BETWEEN start_time AND end_time AND is_active = 1 LIMIT 1";
        $result_election_period = mysqli_query($link, $query_election_period) or die(mysqli_error($link));

        if (mysqli_num_rows($result_election_period) == 1) {
            $election_is_active = TRUE;
        } else {
            $election_is_active = FALSE;
        }

        //Generating a list of candidates so one can vote
        $query_vote_sheet = "SELECT c.id AS candId, first_name, last_name, position_name, 
                                    c.faculty_id, c.batch_id, COUNT(v.user_id) AS num_votes
                               FROM candidates c
                         INNER JOIN positions p
                                  ON p.id = c.position_id
                         INNER JOIN students s 
                                 ON s.id = c.student_id
                          LEFT JOIN votes v
                                 ON v.candidate_id = c.id
                              WHERE (c.faculty_id = {$faculty_id} OR c.faculty_id IS NULL)
                                AND (c.batch_id = {$batch_id} OR c.batch_id IS NULL)
                           GROUP BY c.id
                              ORDER BY p.id, first_name ASC";

        $result_vote_sheet = mysqli_query($link, $query_vote_sheet) or die(mysqli_error($link));

        //Check if a user has voted
        $query_user_vote = "SELECT v.user_id
                              FROM votes v
                             WHERE v.user_id = {$user_id}
                             LIMIT 1";

        $result_user_vote = mysqli_query($link, $query_user_vote) or die(mysqli_error($link));

        //Count position votes
        $query_count_votes = "SELECT p.position_name, COUNT(v.user_id) AS total_votes
                               FROM candidates c
                         INNER JOIN positions p
                                  ON p.id = c.position_id
                         INNER JOIN students s 
                                 ON s.id = c.student_id
                          LEFT JOIN votes v
                                 ON v.candidate_id = c.id
                              WHERE (c.faculty_id = {$faculty_id} OR c.faculty_id IS NULL)
                                AND (c.batch_id = {$batch_id} OR c.batch_id IS NULL)
                           GROUP BY p.id
                              ORDER BY p.id, first_name ASC";

        $result_count_vetes = mysqli_query($link, $query_count_votes) or die(mysqli_error($link));

        while ($row = mysqli_fetch_array($result_count_vetes)) {
            $position_total_votes[$row['position_name']] = $row['total_votes'];
        }

        if (mysqli_num_rows($result_user_vote) == 1) {
            $user_has_voted = TRUE;
        } else {
            $user_has_voted = FALSE;
        }

//        $winner = 0;
        while ($row = mysqli_fetch_array($result_vote_sheet)) {

//
//            if ($row['num_votes'] > $winner) {
//                $winner = $row['num_votes'];
//                $winner_cand[$row["candId"]] = "WINNER";
//            } else {
//                $winner_cand[$row["candId"]] = "";
//            }

            $candidates[$row['position_name']][] = array(
                "full_name" => $row['first_name'] . " " . $row['last_name'],
                "candidate_id" => $row["candId"],
                "num_votes" => $row["num_votes"],
                "total_votes" => $position_total_votes[$row['position_name']]
            );
        }

        $vote_sheet = array(
            "candidates" => $candidates,
            "user_has_voted" => $user_has_voted,
            "election_is_active" => $election_is_active
        );

        echo json_encode($vote_sheet); // Creating json response for voting sheet
        break;

    case 'cast_votes':

        //Cast votes
//        $selectedPresident = $_GET['Presidents'];
//        $sselectedSenetor = $_GET['Senators'];
//        $selectedFr = $_GET['Faculty_Representatives'];

        $user_id = $_GET['user_id'];
//        print_r($_GET);

        foreach ($_GET['votes'] as $candidate_id) { //since number of votes which can be casted is dynamic so we have to loop na hizo id za candidates tunazipata kwenye hiyo for loop
//            if ($candidate_id !== 'cast_votes'  && $candidate_id !== $user_id) {
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
//                }
            }
        }

        echo json_encode($response);

        break;

    case 'reset':
        $user_id = $_GET['userId'];
        $new_password = sha1($_GET['password']); //Hash password

        $query_reset = "UPDATE users SET password = '{$new_password}', is_first_time_login = 0 WHERE id = {$user_id}";
        $result_reset = mysqli_query($link, $query_reset) or die(mysqli_error($link));

        if ($result_reset) {
            $rest_status['reset'] = TRUE;
        } else {
            $rest_status['reset'] = FALSE;
        }

        echo json_encode($rest_status);
        break;
}
?>


