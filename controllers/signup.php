<?php
require_once "../core/auth.php";
require_once "../core/helpers.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = [
        "name"         => cleanInput($_POST["name"]),
        "secondname"   => cleanInput($_POST["secondname"]),
        "Flastname"    => cleanInput($_POST["Flastname"]),
        "Mlastname"    => cleanInput($_POST["Mlastname"]),
        "email"        => cleanInput($_POST["email"]),
        "telefono"     => cleanInput($_POST["telefono"]),
        "password"     => cleanInput($_POST["password"]),
    ];

    $resultado = registerUser($data);

    if ($resultado === true) {
        redirect("../public/sign.php");
    } else {
        echo $resultado; // Muestra el mensaje de error
    }
}
?>
