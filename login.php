<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mini Proyecto</title>
    <!-- Logo -->
    <link rel="icon" type="image/svg+xml" href="/assets/devchallenges.png" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/main.css" />
    <!-- Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,500,1,0" />
</head>

<body id="body" class="body-logins">
    <div id="total-container">
        <div id="card-container">
            <div id="logo-container">
                <img id="logo" alt="logo" src="./assets/devchallenges.svg" />
            </div>
            <div id="title-container">
                <h3 id="title">Login</h3>
            </div>
            <?php
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $email = $_POST["email"];
                $password = $_POST["password"];

                require_once "config/database.php";

                $res = $mysqli->query("select * from usuarios where email = '$email'");
                if ($row = $res->fetch_assoc()) {
                    if (password_verify($password, $row["contraseña"])) {
                        session_start();
                        $_SESSION["userId"] = $row["id"];
                        $_SESSION["user"] = $row;

                        header("Location: views/profile.php");
                    } else {
                        echo "<div class='msg-container'>
                                <span class='msg'>Contraseña incorrecta</span>
                              </div>";
                    }
                } else {
                    echo "<div class='msg-container'>
                                <span class='msg'>Usuario no encontrado</span>
                              </div>";
                }
            }
            ?>
            <form method="post" action="login.php" id="form-login">
                <span id="email-logo" class="material-symbols-outlined">
                    mail
                </span>
                <input type="email" id="email" name="email" placeholder="Email" />
                <span id="password-logo" class="material-symbols-outlined">
                    lock
                </span>
                <input type="password" id="password" name="password" placeholder="Password" />
                <input type="submit" id="button" value="Login">
            </form>
            <div id="or-login-container">
                <span id="or-login">or continue with these social profile</span>
            </div>
            <div id="buttons-login-container">
                <img class="social-button" alt="google-login" src="/assets/Google.svg" />
                <img class="social-button" alt="facebook-login" src="/assets/Facebook.svg" />
                <img class="social-button" alt="x-login" src="/assets/Twitter.svg" />
                <img class="social-button" alt="github-login" src="/assets/Gihub.svg" />
            </div>
            <div id="already-container">
                <span>Don’t have an account yet? <a class="blue" href="/index.php">Register</a></span>
            </div>
        </div>
        <div id="footer">
            <div id="by">created by <a class="gray" href="https://github.com/kevinvillajim">kevinvillajim</a></div>
            <div id="page">devChallenges.io</div>
        </div>

        <div class="darkmode-button-container">
            <div class="switch" id="switch">
                <div class="switch-toggle" id="switchToggle">
                    <span id="switchToggleIcon" class="material-symbols-outlined icon">
                        light_mode
                    </span>
                </div>
            </div>
        </div>
        <script src="/scripts/login.js"></script>
    </div>
</body>

</html>