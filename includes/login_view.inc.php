<?php

declare(strict_types=1);

function check_login_errors() {
    if (isset($_SESSION['errors_login'])) {
        $errors = $_SESSION['errors_login'];

        echo "<br>";

        foreach ($errors as $error) {
            echo '<p class="form-error">' . $error . '</p>';
        }

        unset($_SESSION['errors_login']);
    } else if (isset($_GET["login"]) && $_GET["login"] === "success") {
        echo "<br>";
        echo "<p class='form-success'>Login successful!</p>";
    }
}

function login_input(){

    if(isset($_SESSION['signup_data']["username"])
        && !isset($_SESSION['errors_signup']["username_taken"])) {
        echo '<input type="text" name="username" placeholder="Username" value = "' . $_SESSION['signup_data']["username"] . '">';
    } else {
        echo '<input type="text" name="username" placeholder="Username">';
    }

    echo '<input type="password" name="pwd" placeholder="Password">';

    if(isset($_SESSION['signup_data']["email"])
        && !isset($_SESSION['errors_signup']["email_used"])
        && !isset($_SESSION['errors_signup']["invalid_email"])) {
        echo '<input type="text" name="email" placeholder="E-mail" value = "' . $_SESSION['signup_data']["email"] . '">';
    } else {
        echo '<input type="text" name="email" placeholder="E-mail">';
    }
}