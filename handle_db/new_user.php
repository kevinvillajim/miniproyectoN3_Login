<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = password_hash($_POST["contraseña"], PASSWORD_DEFAULT);

    require_once "../config/database.php";

    $res = $mysqli->query("select * from usuarios where email = '$email'");
    if ($row = $res->fetch_assoc()) {
        "<div class='msg-container'>
                                <span class='msg'>Ya estas registrado, Inicia sesión</span>
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

            header("Location: ../views/profile.php");
        } else {
            echo "Error al Registrar usuario";
        }
    }
}
