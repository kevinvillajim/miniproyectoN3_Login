<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Mini Proyecto</title>
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
                <h3 id="title">Join thousands of learners from around the world</h3>
            </div>
            <div id="text-container">
                <p id="text">
                    Master web development by making real-life projects. There are multiple paths for you to choose
                </p>
            </div>
            <?php
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $email = $_POST["email"];
                $password = password_hash($_POST["contraseña"], PASSWORD_DEFAULT);
                if (!empty($email) && !empty($password)) {
                    require_once "config/database.php";
                    $res = $mysqli->query("select * from usuarios where email = '$email'");
                    if ($row = $res->fetch_assoc()) {
                        echo "<div class='msg-container'>
                                <span class='msg'>Ya estas registrado, por favor inicia sesión</span>
                              </div>";
                    } else {
                        $mysqli->query("INSERT INTO usuarios (email, contraseña) VALUES ('$email', '$password')");
                        $userId = $mysqli->insert_id;
                        $res = $mysqli->query("select * from usuarios where email = '$email' and contraseña = '$password'");

                        if ($res->num_rows === 1) {
                            $userData = $res->fetch_assoc();

                            session_start();
                            $_SESSION["userId"] = $userId;
                            $_SESSION["user"] = $userData;

                            header("Location: views/profile.php");
                        } else {
                            echo "Error al Registrar usuario";
                        }
                    }
                } else {
                    echo "<div class='msg-container'>
                                <span class='msg'>Ingresa un usuario y contraseña válidos</span>
                              </div>";
                }
            }
            ?>
            <form method="post" id="form-login" action="/index.php">
                <span id="email-logo" class="material-symbols-outlined">
                    mail
                </span>
                <input type="email" id="email" name="email" placeholder="Email" required />
                <span id="password-logo" class="material-symbols-outlined">
                    lock
                </span>
                <input type="password" id="password" name="contraseña" placeholder="Password" required />
                <input type="submit" id="button" value="Start coding now">
            </form>
            <div id="or-login-container">
                <span id="or-login">or continue with these social profile</span>
            </div>
            <div id="buttons-login-container">
                <img class="social-button" alt="google-login" src="/assets/Google.svg" />
                <img id="facebook-login" class="social-button" alt="facebook-login" src="/assets/Facebook.svg" />
                <img class="social-button" alt="x-login" src="/assets/Twitter.svg" onclick="checkLoginState()" />
                <img class="social-button" alt="github-login" src="/assets/Gihub.svg" />
            </div>
            <div id="already-container">
                <span>Adready a member? <a class="blue" href="/login.php">Login</a></span>
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
        <script src="./scripts/register.js" defer></script>
    </div>
    <div id="info">

    </div>
</body>

</html>