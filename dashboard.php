<!DOCTYPE html>
<?php
error_reporting(0);
include './config/database.php';

$query_select_presidents = "SELECT c.id AS candId, first_name, last_name, position_name, 
                                    c.faculty_id, c.batch_id, COUNT(v.user_id) AS num_votes
                               FROM candidates c
                         INNER JOIN positions p
                                  ON p.id = c.position_id
                         INNER JOIN students s 
                                 ON s.id = c.student_id
                          LEFT JOIN votes v
                                 ON v.candidate_id = c.id
                              WHERE position_name = 'Presidents'
                           GROUP BY c.id
                              ORDER BY num_votes DESC, first_name ASC";
$result_select_presdents = mysqli_query($link, $query_select_presidents) or dir(mysqli_error($link));


//Count position votes
$query_count_votes = "SELECT p.position_name, COUNT(v.user_id) AS total_votes
                               FROM candidates c
                         INNER JOIN positions p
                                  ON p.id = c.position_id
                          LEFT JOIN votes v
                                 ON v.candidate_id = c.id
                         WHERE position_name = 'Presidents'";

$result_count_vetes = mysqli_query($link, $query_count_votes) or die(mysqli_error($link));
$row = mysqli_fetch_array($result_count_vetes) or die(mysqli_error($link));
$total_votes_presidents = $row['total_votes'];

$query_select_senators = "SELECT c.id AS candId, first_name, last_name, position_name, 
                                     f.faculty_name, COUNT(v.user_id) AS num_votes
                               FROM candidates c
                         INNER JOIN positions p
                                  ON p.id = c.position_id
                         INNER JOIN students s 
                                 ON s.id = c.student_id
                              INNER JOIN faculties f
                                 ON f.id = s.faculty_id
                          LEFT JOIN votes v
                                 ON v.candidate_id = c.id
                              WHERE position_name = 'Senators'
                           GROUP BY c.id
                              ORDER BY faculty_name, num_votes DESC,  first_name";
$result_select_senators = mysqli_query($link, $query_select_senators) or dir(mysqli_error($link));


//Count position votes
$query_count_votes = "SELECT faculty_name, COUNT(v.user_id) AS total_votes
                               FROM candidates c
                         INNER JOIN positions p
                                  ON p.id = c.position_id
                         INNER JOIN students s 
                                 ON s.id = c.student_id
                         INNER JOIN faculties f
                         ON f.id = s.faculty_id
                          LEFT JOIN votes v
                                 ON v.candidate_id = c.id
                          WHERE position_name = 'Senators'
                           GROUP BY f.id
                              ORDER BY p.id";

$result_count_vetes = mysqli_query($link, $query_count_votes) or die(mysqli_error($link));

while ($row = mysqli_fetch_array($result_count_vetes)) {
    $position_total_votes[$row['faculty_name']] = $row['total_votes'];
}

$query_select_fr = "SELECT c.id AS candId, first_name, last_name, position_name, 
                                    faculty_name, batch_name, COUNT(v.user_id) AS num_votes
                               FROM candidates c
                         INNER JOIN positions p
                                  ON p.id = c.position_id
                         INNER JOIN students s 
                                 ON s.id = c.student_id
                         INNER JOIN batches b
                                 ON b.id = s.batch_id
                         INNER JOIN faculties f
                                 ON f.id = s.faculty_id
                          LEFT JOIN votes v
                                 ON v.candidate_id = c.id
                              WHERE position_name = 'Faculty Representatives'
                           GROUP BY c.id
                              ORDER BY faculty_name, batch_name, num_votes DESC, first_name";
$result_select_fr = mysqli_query($link, $query_select_fr) or dir(mysqli_error($link));

//Count position votes
$query_count_votes = "SELECT faculty_name, batch_name, COUNT(v.user_id) AS total_votes
                               FROM candidates c
                         INNER JOIN positions p
                                  ON p.id = c.position_id
                         INNER JOIN students s 
                                 ON s.id = c.student_id
                         INNER JOIN faculties f
                         ON f.id = s.faculty_id
                          INNER JOIN batches b
                         ON b.id = s.batch_id
                          LEFT JOIN votes v
                                 ON v.candidate_id = c.id
                          WHERE position_name = 'Faculty Representatives'
                           GROUP BY f.id, b.id";

$result_count_votes = mysqli_query($link, $query_count_votes) or die(mysqli_error($link));


while ($row = mysqli_fetch_array($result_count_votes)) {
    $position_total_votes2[$row['faculty_name']] = array($row['batch_name'] => $row['total_votes']) ;
}
//

?>
<html>
    <head>
        <title>Election panel</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/material.css" rel="stylesheet" type="text/css"/>
        <link href="css/election_panel.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <!-- The drawer is always open in large screens. The header is always shown,
  even in small screens. -->
        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
             mdl-layout--fixed-header">
            <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
                <?php include './include/header.php'; ?>
                <?php include './include/drawer.php'; ?>
                <main class="mdl-layout__content">
                    <div class="page-content"><!-- Your content goes here --></div>
                </main>
            </div>
            <main class="mdl-layout__content">
                <div class="page-content"><!-- Your content goes here -->
                    <div class="page-wrapper">

                        <div class="actions">
                            <h5>Presidents</h5>
                        </div>


                        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width">
                            <thead>
                            <th class="mdl-data-table__cell--non-numeric">FULL NAME</th>
                            <th>VOTES</th>
                            <tbody>

                                <?php while ($row = mysqli_fetch_array($result_select_presdents)) { ?>
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric">

                                            <p class="full-name"><img src="images/president.jpg" width="44"  class="avatar"/><?php echo $row['first_name'] . " " . $row['last_name'] ?>
                                        </td>
                                        <td><?php echo $row['num_votes'] ?> of <?php echo $total_votes_presidents ?></td>
                                    </tr>
                                <?php } ?>

                            </tbody>`
                        </table>


                        <div class="actions">
                            <h5>Senators</h5>
                        </div>
                        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width">
                            <thead>
                            <th class="mdl-data-table__cell--non-numeric">FULL NAME</th>
                            <th class="mdl-data-table__cell--non-numeric">FACULTY</th>
                            <th>VOTES</th>
                            </thead>
                            <tbody>

                                <?php while ($row = mysqli_fetch_array($result_select_senators)) { ?>
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric">

                                            <p class="full-name"><img src="images/president.jpg" width="44"  class="avatar"/><?php echo $row['first_name'] . " " . $row['last_name'] ?></p>
                                        </td>
                                        <td class="mdl-data-table__cell--non-numeric"><?php echo $row['faculty_name'] ?></td>
                                        <td><?php echo $row['num_votes'] ?> of <?php echo $position_total_votes[$row['faculty_name']] ?></td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                        </table>

                        <div class="actions">
                            <h5>Faculty Representatives</h5>
                        </div>
                        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width">
                            <thead>
                            <th class="mdl-data-table__cell--non-numeric">FULL NAME</th>
                            <th class="mdl-data-table__cell--non-numeric">FACULTY</th>
                            <th class="mdl-data-table__cell--non-numeric">BATCH</th>
                            <th>VOTES</th>
                            </thead>
                            <tbody>

                                <?php
                                $j = 0;
                                while ($row = mysqli_fetch_array($result_select_fr)) {
                                    ?>
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric">

                                            <p class="full-name"><img src="images/president.jpg" width="44"  class="avatar"/><?php echo $row['first_name'] . " " . $row['last_name'] ?></p>
                                        </td>
                                        <td class="mdl-data-table__cell--non-numeric"><?php echo $row['faculty_name'] ?></td>
                                        <td class="mdl-data-table__cell--non-numeric"><?php echo $row['batch_name'] ?></td>
                                        <td><?php echo $row['num_votes'] ?> of <?php echo $position_total_votes2[$row['faculty_name']][$row['batch_name']] ?></td>
                                    </tr>
                                <?php
                                $j++;
                                } 
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>

        <script src="js/material.js" type="text/javascript"></script>
        <script src="js/jquery-3.3.1.js" type="text/javascript"></script>
        <script src="js/functions.js" type="text/javascript"></script>
        <script src="js/election_panel.js" type="text/javascript"></script>
    </body>
</html>
