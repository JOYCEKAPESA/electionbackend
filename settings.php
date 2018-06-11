<!DOCTYPE html>
<?php
include './config/database.php';

$query_election_period = "SELECT id, `period`, start_time, end_time FROM election_period";
$result_election_period = mysqli_query($link, $query_election_period) or dir(mysqli_error($link));
$row = mysqli_fetch_array($result_election_period);
?>
<html>
    <head>
        <title>Settings</title>
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

                        <form action="add_new_vote_period.php" method="POST">
                            
                            <input type="hidden" value="<?php echo $row['id']?>" name="id"/>

                            <div class="demo-card-square mdl-card mdl-shadow--2dp full-width">
                                <div class="mdl-card__title">
                                    <h2 class="mdl-card__title-text">Vote period</h2>
                                </div>
                                <div class="mdl-card__supporting-text">

                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <input class="mdl-textfield__input" name="period" value="<?php echo $row['period'] ?>" type="text" id="sample3">
                                        <label class="mdl-textfield__label" for="sample3">Period</label>
                                    </div>
                                    <br/>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <input class="mdl-textfield__input" name="start_time" value="<?php echo $row['start_time'] ?>" type="text" id="sample3">
                                        <label class="mdl-textfield__label" for="sample3">Start time</label>
                                    </div>
                                    <br/>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <input class="mdl-textfield__input" name="end_time" value="<?php echo $row['end_time'] ?>" type="text" id="sample3">
                                        <label class="mdl-textfield__label" for="sample3">End time</label>
                                    </div>

                                </div>
                                <div class="mdl-card__actions mdl-card--border">
                                    <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" type="submit">Save</button>
                                </div>
                            </div>
                        </form>
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

