<?php
    require_once 'includes/config_session.inc.php';
    require_once 'includes/signup_view.inc.php';
    require_once 'includes/login_view.inc.php';
?>

<!DOCTYPE>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<div class="container">
    <h3>Login</h3>

    <form action="includes/login.inc.php" method="post" class="form">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="pwd" placeholder="Password">
        <button type="submit">Login</button>
    </form>

    <?php
        check_login_errors();
    ?>

    <h3>Signup</h3>

    <form action="includes/signup.inc.php" method="post" class="form">
        <?php
            signup_input();
        ?>
        <button type="submit">Signup</button>
    </form>

    <?php
        check_signup_errors();
    ?>
</div>
</body>
</html>