<?php include './config/database.php'; ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add student</title>
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
                        <form action="add_new_student.php" method="POST">

                            <div class="demo-card-square mdl-card mdl-shadow--2dp full-width">
                                <div class="mdl-card__title">
                                    <h2 class="mdl-card__title-text">Add student</h2>
                                </div>
                                <div class="mdl-card__supporting-text">

                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <input class="mdl-textfield__input" name="registration_no" type="text" id="sample3">
                                        <label class="mdl-textfield__label" for="sample3">Registration no</label>
                                    </div>
                                    <br/>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <input class="mdl-textfield__input" name="first_name" type="text" id="sample3">
                                        <label class="mdl-textfield__label" for="sample3">First name</label>
                                    </div>
                                    <br/>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <input class="mdl-textfield__input" name="last_name" type="text" id="sample3">
                                        <label class="mdl-textfield__label" for="sample3">Last name</label>
                                    </div>

                                    <br/>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <select class="mdl-textfield__input" id="faculty" name="faculty">

                                            <?php
                                            $result_faculty = mysqli_query($link, "SELECT * FROM faculties") or die(mysqli_error($link));
                                            while ($row = mysqli_fetch_array($result_faculty)) {
                                                ?>
                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['faculty_name'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <label class="mdl-textfield__label" for="faculty">Faculty</label>
                                    </div>

                                    <br/>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <select class="mdl-textfield__input" id="course" name="course">
                                        </select>
                                        <label class="mdl-textfield__label" for="course">Course</label>
                                    </div>
                                    <br/>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <select class="mdl-textfield__input" id="batch" name="batch">
                                        </select>
                                        <label class="mdl-textfield__label" for="course">Batch</label>
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

