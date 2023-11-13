<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once "../config/database.php";
    session_start();
    extract($_POST);
    $imgName = $_FILES["upload-photo"]["name"];
    $typeImage = substr($_FILES["upload-photo"]["type"], 0, 5);

    if ($typeImage === "image") {
        $tmp_name = $_FILES["upload-photo"]["tmp_name"];
        $contenido = addslashes(file_get_contents($tmp_name));
    } else {
        require_once "../config/database.php";
        $res = $mysqli->query("select * from usuarios");
        $data = $res->fetch_all(MYSQLI_ASSOC);
        $id = $_SESSION["userId"];
        foreach ($data as $usuario) {
            if ($usuario["id"] === $id) {
                if (!empty($usuario["photo"])) {
                    $imgDec = base64_encode($usuario["photo"]);
                    $contenido = $imgDec;
                }
            }
        }
    }

    if ($email !== "" && $contraseña !== "") {

        $_SESSION["user"]["photo"] = $contenido;
        $_SESSION["user"]["name"] = $name;
        $_SESSION["user"]["bio"] = $bio;
        $_SESSION["user"]["phone"] = $phone;
        $_SESSION["user"]["email"] = $email;
        $_SESSION["user"]["contraseña"] = $contraseña;


        $mysqli->query("UPDATE usuarios SET name = '$name', bio = '$bio',
phone = '$phone', email = '$email', contraseña = '$contraseña',
photo = '$contenido' WHERE id = {$_SESSION["userId"]}");
        $_SESSION["user"]["photo"] = base64_encode($contenido);
    }

    header("Location: ../views/profile.php");
}
