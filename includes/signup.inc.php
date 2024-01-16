<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    $email = $_POST['email'];

    try {

        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';

        // error handlers
        $errors = [];
    
        if (is_input_empty($username, $pwd, $email)) {
            $errors["empty_inputs"] = 'Fill in all fields';
        }

        if (is_email_invalid($email)) {
            $errors["invalid email"] = "Invalid email used";
        }

        if (is_username_taken($pdo, $username)) {
            $errors["username_used"] = "Username already taken";
        }

        if (is_email_registered($pdo, $email)) {
            $errors["email_ised"] = "Email already registered";
        }

        require_once 'config_sessions.inc.php';

        //check if there are any errors
        if ($errors) {
            $_SESSION['errors_signup'] = $errors;
            header("Location: ../index.php");
            die();
        }

        // create the user and store in the database
        create_user($pdo, $pwd, $username, $email);
        header("Location: ../index.php?signup=success");

        //kill the conection to the database
        $pdo = null;
        $stmt = null;
        die();

    } catch(PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

} else {
    header("Location: ../index.php");
    die();
}