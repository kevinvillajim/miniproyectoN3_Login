<?php
        session_start();
        if (!isset($_SESSION["user"])) {
            echo "No autorizado, debes iniciar sesión primero.";
            echo "</br>";
            echo "<a href='../login.php'>Regresar a Login</a>";
            echo "</br>";
            echo "No eres miembro?, crea una cuenta";
            echo "</br>";
            echo "<a href='../index.php'>Crear cuenta</a>";
            die();
        }
        ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perfil - Mini Proyecto</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet" />
    <!-- Style -->
    <link rel="stylesheet" href="../styles/main.css" />
    <!-- Icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,500,1,0" />
    <!-- Script JS -->
    <script src="../scripts/profile.js" defer></script>
    <!-- Logo -->
    <link rel="icon" type="image/svg+xml" href="../assets/devchallenges.png" />
</head>

<body id="body">
    <header id="header">
        <div id="logo-header-container">
            <img id="logo-header" alt="logo-header" src="../assets/devchallenges.svg" />
        </div>
        <div id="profile-user">
            <div id="avatar-img-container">
                <?php
                        require_once "../config/database.php";

                        $id = $_SESSION["userId"];
                        $res = $mysqli->query("SELECT * FROM usuarios WHERE id = $id ");
                        $data = $res->fetch_assoc();

                        if (!empty($data["photo"])) {
                            $imgDec = base64_encode($data["photo"]);
                            echo "<img id='avatar-img' alt='avatar-img' src='data:image/*;base64,$imgDec' />";
                        } else {
                            echo "<img id='avatar-img' src='../assets/avatar.png' alt='avatar-img'>";
                        }
                        ?>
            </div>
            <span id="avatar-name">
                <?php echo $_SESSION["user"]["name"] ?>
            </span>
            <span id="avatar-icon-more" class="material-symbols-outlined">
                expand_more
            </span>
        </div>
    </header>
    <div id="modal-menu">
        <a class="link-clean" href="profile.php">
            <div id="my-profile" class="modal-option modal-gray">
                <span class="material-symbols-outlined"> person </span>
                <span class="text-modal">My Profile</span>
            </div>
        </a>
        <div id="dark-mode" class="modal-option modal-gray">
            <span id="logo-dark" class="material-symbols-outlined"> dark_mode </span>
            <span id="text-dark" class="text-modal">Dark Mode</span>
        </div>
        <div id="group-chat" class="modal-option modal-gray">
            <span class="material-symbols-outlined"> group </span>
            <span class="text-modal">Group Chat</span>
        </div>
        <hr />
        <a class="link-clean" href="../handle_db/logout.php">
            <div id="logout" class="modal-option modal-red">
                <span class="material-symbols-outlined"> logout </span>
                <span class="text-modal">Logout</span>
            </div>
        </a>
    </div>
    <div id="body-container">
        <section id="title-info">
            <h1 id="title-personal-info">Personal info</h1>
            <h3 id="subtitle-info">Basic info, like your name and photo</h3>
        </section>
        <section id="profile-card-container">
            <div id="profile-container">
                <div id="profile-info-container">
                    <h4 id="profile">Profile</h4>
                    <p id="profile-about">Some info may be visible to other people</p>
                </div>
                <a id="edit-button" href="../views/edit-profile.php">Edit</a>
            </div>
            <div id="photo-container" class="container-profile">
                <div class="left-container">
                    <h6 id="photo-title" class="title-profile">PHOTO</h6>
                </div>
                <div class="right-container">
                    <div id="photo-img-container">
                        <?php
                                if (!empty($data["photo"])) {
                                    $imgDec = base64_encode($data["photo"]);
                                    echo "<img id='photo' alt='profile-photo' src='data:image/*;base64,$imgDec' />";
                                } else {
                                    echo "<img id='photo' alt='profile-photo' src='../assets/avatar.png' alt='avatar-img'>";
                                }
                                ?>
                    </div>
                </div>
            </div>
            <div id="name-container" class="container-profile">
                <div class="left-container">
                    <h6 id="name-title" class="title-profile">NAME</h6>
                </div>
                <div class="right-container">
                    <p id="name" class="content-profile">
                        <?php echo $_SESSION["user"]["name"] ?>
                    </p>
                </div>
            </div>
            <div id="bio-container" class="container-profile">
                <div class="left-container">
                    <h6 id="bio-title" class="title-profile">BIO</h6>
                </div>
                <div class="right-container">
                    <p id="bio" class="content-profile">
                        <?php echo $_SESSION["user"]["bio"] ?>
                    </p>
                </div>
            </div>
            <div id="phone-container" class="container-profile">
                <div class="left-container">
                    <h6 id="phone-title" class="title-profile">PHONE</h6>
                </div>
                <div class="right-container">
                    <p id="phone" class="content-profile">
                        <?php echo $_SESSION["user"]["phone"] ?>
                    </p>
                </div>
            </div>
            <div id="email-container" class="container-profile">
                <div class="left-container">
                    <h6 id="email-title" class="title-profile">EMAIL</h6>
                </div>
                <div class="right-container">
                    <p id="email-profile" class="content-profile">
                        <?php echo $_SESSION["user"]["email"] ?>
                    </p>
                </div>
            </div>
            <div id="password-container" class="container-profile">
                <div class="left-container">
                    <h6 id="password-title" class="title-profile">PASSWORD</h6>
                </div>
                <div class="right-container">
                    <p id="password-profile" class="content-profile">
                        <?php echo str_repeat("•", strlen($_SESSION["user"]["contraseña"])); ?></p>
                </div>
            </div>
        </section>
        <div id="footer">
            <div id="by">
                created by
                <a class="gray" href="https://github.com/kevinvillajim">kevinvillajim</a>
            </div>
            <div id="page">devChallenges.io</div>
        </div>
    </div>
</body>

</html>