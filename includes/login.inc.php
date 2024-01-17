<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];

    try {
        
        require_once "dbh.inc.php";
        require_once "login_model.inc.php";
        require_once "login_contr.inc.php";

        //error handlers
        $errors = [];

        if (is_input_empty($username, $pwd)) {
            $errors["empty_input"] = "Fill in all the fields!";
        }

        $result = get_user($pdo, $username);

        if (is_username_wrong($username)) {
            $errors["login_incorrect"] = "Incorrect login info";
        }

        if (!is_username_wrong($result) && is_password_wrong($pwd, $result["pwd"])) {
            $errors["login_incorrect"] = "Incorrect login info!.";
        }

        require_once 'config_sessions.inc.php';

        // check if there are any errors logging in
        if ($errors) {
            $_SESSION['errors_login'] = $errors;
            header("Location: ../index.php");

            die();
        }

        // create a new session to append the users id if users is already logged into the website
        $newSessionId = session_create_id();
        $sessionID = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);
        
        $_SESSION["last_generation"] = time();

        header("Location: ../index.php?login=success");
        $pdo = null;
        $stmt = null;

        die();
    } catch (PDOException $e) {
        die("Query failed:" . $e->getMessage());
    }
} else {
    header('Location: ../index.php');
    die();
}
