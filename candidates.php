<!DOCTYPE html>
<?php
include './config/database.php';

$query_select_presidents = "SELECT c.id, position_name, first_name, last_name, faculty_name, batch_name 
                              FROM candidates c
                        INNER JOIN positions p
                                ON p.id = c.position_id
                        INNER JOIN students s
                                ON s.id = c.student_id
                        LEFT JOIN faculties f
                                ON f.id = c.faculty_id
                        LEFT JOIN batches b
                                ON b.id = c.batch_id
                             WHERE position_name = 'Presidents'";
$result_select_presdents = mysqli_query($link, $query_select_presidents) or dir(mysqli_error($link));

$query_select_senators = "SELECT c.id, position_name, first_name, last_name, faculty_name, batch_name 
                              FROM candidates c
                        INNER JOIN positions p
                                ON p.id = c.position_id
                        INNER JOIN students s
                                ON s.id = c.student_id
                        LEFT JOIN faculties f
                                ON f.id = c.faculty_id
                        LEFT JOIN batches b
                                ON b.id = c.batch_id
                             WHERE position_name = 'Senators'";
$result_select_senators = mysqli_query($link, $query_select_senators) or dir(mysqli_error($link));

$query_select_fr = "SELECT c.id, position_name, first_name, last_name, faculty_name, batch_name 
                              FROM candidates c
                        INNER JOIN positions p
                                ON p.id = c.position_id
                        INNER JOIN students s
                                ON s.id = c.student_id
                        LEFT JOIN faculties f
                                ON f.id = c.faculty_id
                        LEFT JOIN batches b
                                ON b.id = c.batch_id
                             WHERE position_name = 'Faculty Representatives'";
$result_select_fr = mysqli_query($link, $query_select_fr) or dir(mysqli_error($link));
?>
<html>
    <head>
        <title>Candidates</title>
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
                                <tr>
                                    <th class="mdl-data-table__cell--non-numeric">FULL NAME</th>
                                    <!--<th>Quantity</th>-->
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php while ($row = mysqli_fetch_array($result_select_presdents)) { ?>
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric">

                                            <p class="full-name"><img src="images/president.jpg" width="44"  class="avatar"/><?php echo $row['first_name'] . " " . $row['last_name'] ?></p></td>
                                        <!--<td>25</td>-->
                                        <td>
                                            <a href="edit_candidate.php?id=<?php echo $row['id'] ?>">
                                                <button class="mdl-button mdl-js-button mdl-js-ripple-effect">Edit</button>
                                            </a>
                                            <a href="delete_candidate.php?id=<?php echo $row['id'] ?>">
                                                <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--accent">Delete</button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>

                    
                        <div class="actions">
                            <h5>Senators</h5>
                        </div>



                        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width">
                            <thead>
                                <tr>
                                    <th class="mdl-data-table__cell--non-numeric">FULL NAME</th>
                                    <th class="mdl-data-table__cell--non-numeric">FACULTY</th>
                                    <!--<th>Quantity</th>-->
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php while ($row = mysqli_fetch_array($result_select_senators)) { ?>
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric">

                                            <p class="full-name"><img src="images/president.jpg" width="44"  class="avatar"/><?php echo $row['first_name'] . " " . $row['last_name'] ?></p></td>
                                        <td class="mdl-data-table__cell--non-numeric"><?php echo $row['faculty_name'] ?></td>
                                        <!--<td>25</td>-->
                                        <td>
                                            <a href="edit_candidate.php?id=<?php echo $row['id'] ?>">
                                                <button class="mdl-button mdl-js-button mdl-js-ripple-effect">Edit</button>
                                            </a>
                                            <a href="delete_candidate.php?id=<?php echo $row['id'] ?>">
                                                <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--accent">Delete</button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>

                        <div class="actions">
                            <h5>Faculty Representatives</h5>
                        </div>



                        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width">
                            <thead>
                                <tr>
                                    <th class="mdl-data-table__cell--non-numeric">FULL NAME</th>
                                    <th class="mdl-data-table__cell--non-numeric">FACULTY</th>
                                    <th class="mdl-data-table__cell--non-numeric">BATCH</th>
                                    <!--<th>Quantity</th>-->
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php while ($row = mysqli_fetch_array($result_select_fr)) { ?>
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric">

                                            <p class="full-name"><img src="images/president.jpg" width="44"  class="avatar"/><?php echo $row['first_name'] . " " . $row['last_name'] ?></p></td>
                                        <td class="mdl-data-table__cell--non-numeric"><?php echo $row['faculty_name'] ?></td>
                                        <td class="mdl-data-table__cell--non-numeric"><?php echo $row['batch_name'] ?></td>
                                        <!--<td>25</td>-->
                                        <td>
                                            <a href="edit_candidate.php?id=<?php echo $row['id'] ?>">
                                                <button class="mdl-button mdl-js-button mdl-js-ripple-effect">Edit</button>
                                            </a>
                                            <a href="delete_candidate.php?id=<?php echo $row['id'] ?>">
                                                <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--accent">Delete</button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>

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
