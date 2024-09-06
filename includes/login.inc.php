<?php

global $pdo;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];

    try {

        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        // ERROR HANDLERS
        $errors = [];

        if (is_input_empty($username, $pwd)){
            $errors["empty_input"] = "Fill in all fields";
        }

        $user = get_user($pdo, $username);

        if (!is_input_empty($username, $pwd) && is_username_wrong($user)) {
            $errors["login_incorrect"] = "Incorrect login info";
        }
        if (!is_input_empty($username, $pwd) && !is_username_wrong($user) && is_password_wrong($pwd, $user["password"])) {
            $errors["login_incorrect"] = "Incorrect login info";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_login"] = $errors;

            header("Location: ../login.php");
            die();
        }

        $newSessionId=session_create_id();
        $sessionId=$newSessionId . "_" . $user["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_username"] = htmlspecialchars($user["username"]);
        $_SESSION["last_regeneration"] = time();

        header("Location: ../login.php?login=success");
        $pdo = null;
        $stmt = null;
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../login.php");
    die();
}
