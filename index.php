<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'includes/config_sessions.inc.php';
require_once 'includes/signup_view.inc.php';
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, inital-scale=1.0" >
        <title>Auth</title>
    </head>

    <body>
        <h3>Signup</h3>

        <div>
            <form action="includes/signup.inc.php" method="post">
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="pwd" placeholder="password">
                <input type="text" name="email" placeholder="E-mail">
                <button>Signup</button>
            </form>
        </div>

        <?php 
        check_signup_errors();
        ?>

    </body>
</html>