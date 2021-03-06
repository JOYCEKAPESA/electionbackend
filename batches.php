<!DOCTYPE html>
<?php
include './config/database.php';

$query_select_batches = "SELECT b.id, batch_name, course_name 
                         FROM batches b 
                   INNER JOIN courses c 
                           ON b.course_id = c.id";
$result_select_batches = mysqli_query($link, $query_select_batches) or dir(mysqli_error($link));
?>
<html>
    <head>
        <title>Batches</title>
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
                            <a href="add_batch.php">
                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"> Add batch </button>
                            </a>
                        </div>


                        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width">
                            <thead>
                                <tr>
                                    <th class="mdl-data-table__cell--non-numeric">BATCH</th>
                                    <th class="mdl-data-table__cell--non-numeric">COURSE</th>
                                    <!--<th>Quantity</th>-->
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php while ($row = mysqli_fetch_array($result_select_batches)) { ?>
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric"><?php echo $row['batch_name'] ?></td>
                                        <td class="mdl-data-table__cell--non-numeric"><?php echo $row['course_name'] ?></td>
                                        <!--<td>25</td>-->
                                        <td>
                                            <a href="view_batches.php?id=<?php echo $row['id'] ?>">
                                                <button class="mdl-button mdl-js-button mdl-js-ripple-effect">Edit</button>
                                            </a>
                                            <a href="delete_batch.php?id=<?php echo $row['id'] ?>">
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

