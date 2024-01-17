<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'includes/config_sessions.inc.php';
require_once 'includes/signup_view.inc.php';
require_once 'includes/login_view.inc.php';
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
        <h2>
            Ofon's Login System
        </h2>

        <h3>
            <?php 
            output_username();
            ?>
        </h3>

        <?php 
            if (!isset($_SESSION['user_id'])) { ?>
                <h3>Login</h3>

                <div>
                    <form action="includes/login.inc.php" method="post">
                        <input type="text" name="username" placeholder="Username">
                        <input type="password" name="pwd" placeholder="password">

                        <button>Login</button>
                    </form>
                </div>
        <?php } ?>

        <?php 
        check_login_errors();
        ?>

        <?php 
        if (!isset($_SESSION['user_id'])) { ?>
            <h3>Signup</h3>

            <div>
                <form action="includes/signup.inc.php" method="post">
                    <?php
                        signup_inputs();
                    ?>
                    <button>Signup</button>
                </form>
            </div>
         <?php } ?>

        <?php 
        check_signup_errors();
        ?>

        <?php 
            if (isset($_SESSION['user_id'])) { ?>
                <h3>Logout</h3>

            <div>
                <form action="includes/logout.inc.php" method="post">
                    <button>Logout</button>
                </form>
            </div>
        <?php } ?>

    </body>
</html>