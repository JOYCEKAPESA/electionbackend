<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/material.css" rel="stylesheet" type="text/css"/>
        <link href="css/election_panel.css" rel="stylesheet" type="text/css"/>
    </head>
    <body class="login-home">

        <form action="login.php" method="POST" id="form-login">
            <div class="mdl-card login-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">Election panel</h2>
                </div>
                <!--            <div class="mdl-card__media">
                
                            </div>-->
                <div class="mdl-card__supporting-text">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" name="username" type="text" id="addr1">
                        <label class="mdl-textfield__label" for="addr1">Username</label>
                    </div>

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" name="password" type="text" id="addr1">
                        <label class="mdl-textfield__label" for="addr1">Password</label>
                    </div>
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="btn-login">
                        Login
                    </a>
                </div>
            </div>
        </form>


        <script src="js/material.js" type="text/javascript"></script>
        <script src="js/jquery-3.3.1.js" type="text/javascript"></script>
        <script src="js/functions.js" type="text/javascript"></script>
        <script src="js/election_panel.js" type="text/javascript"></script>
    </body>
</html>
