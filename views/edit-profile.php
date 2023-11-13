<?php
      session_start();
      if (!isset($_SESSION["user"])) {
        echo "Debes iniciar sesión primero.";
        die();
      }
      ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Editar Perfil - Mini Proyecto</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../styles/main.css" />
    <!-- Icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,500,1,0" />
    <!-- Script JS -->
    <script src="../scripts/edit-profile.js" defer></script>
    <!-- Logo -->
    <link rel="icon" type="image/svg+xml" href="../assets/devchallenges.png" />
</head>

<body id="body">
    <header id="header">
        <div id="logo-header-container">
            <img id="logo-header" alt="logo-header" src="../assets/devchallenges.svg" />
        </div>
        <div id="profile-user">
            <div id="avatar-img-container"><?php
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
        <a class="link-clean" href="../views/profile.php">
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
        <section id="back-container">
            <a href="../views/profile.php" id="back"><span class="material-symbols-outlined"> arrow_back_ios </span>
                Back</a>
        </section>
        <section id="profile-card-container2">
            <div id="profile-container2">
                <div id="profile-info-container">
                    <h4 id="profile">Change Info</h4>
                    <p id="profile-about">
                        Changes will be reflected to every services
                    </p>
                </div>
            </div>
            <form id="frm-edit" action="../handle_db/update.php" method="post" enctype="multipart/form-data">
                <div id="photo-t-container">
                    <div class="photo-container"><?php
                  if (!empty($data["photo"])) {
                    $imgDec = base64_encode($data["photo"]);
                    echo "<img id='photo' alt='profile-photo' src='data:image/*;base64,$imgDec' />";
                  } else {
                    echo "<img id='photo' alt='profile-photo' src='../assets/avatar.png' alt='avatar-img'>";
                  }
                  ?>
                        <label for="upload-photo" <span id="change-photo-icon" class="material-symbols-outlined">
                            photo_camera
                            </span>
                        </label>
                        <input id="upload-photo" type="file" accept="image/*" name="upload-photo" />
                        </img>
                    </div>
                    <div id="photo-text-container">
                        <h6 id="name-title2" class="title-profile">CHANGE PHOTO</h6>
                    </div>
                </div>
                <div class="frm-container">
                    <label class="frm-label" for="frm-input-name">Name</label>
                    <input class="frm-input" name="name" id="frm-input-name" type="text"
                        placeholder="Enter your name..." value="<?php
                if ($_SESSION["user"]["name"] !== "") {
                  echo $_SESSION["user"]["name"];
                } else {
                  echo "";
                } ?>" />
                </div>
                <div class="frm-container">
                    <label class="frm-label" for="frm-input-bio">Bio</label>
                    <input class="frm-input" name="bio" id="frm-input-bio" type="text" placeholder="Enter your bio..."
                        value="<?php
                if ($_SESSION["user"]["bio"] !== "") {
                  echo $_SESSION["user"]["bio"];
                } else {
                  echo "";
                } ?>" />
                </div>
                <div class="frm-container">
                    <label class="frm-label" for="frm-input-phone">Phone</label>
                    <input class="frm-input" name="phone" id="frm-input-phone" type="text"
                        placeholder="Enter your phone..." value="<?php
                if ($_SESSION["user"]["phone"] !== "") {
                  echo $_SESSION["user"]["phone"];
                } else {
                  echo "";
                } ?>" />
                </div>
                <div class="frm-container">
                    <label class="frm-label" for="frm-input-email">Email</label>
                    <input class="frm-input" name="email" id="frm-input-email" type="email"
                        placeholder="Enter your email..." value="<?php
                if ($_SESSION["user"]["email"] !== "") {
                  echo $_SESSION["user"]["email"];
                } else {
                  echo "";
                } ?>" required />
                </div>
                <div class="frm-container">
                    <label class="frm-label" for="frm-input-password">Password</label>
                    <input class="frm-input" name="contraseña" id="frm-input-password" type="password"
                        placeholder="Enter your password..." value="<?php
                if ($_SESSION["user"]["contraseña"] !== "") {
                  echo $_SESSION["user"]["contraseña"];
                } else {
                  echo "";
                } ?>" required />
                </div>
                <input id="btn-frm" type="submit" value="Save" />
            </form>
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