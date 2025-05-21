<?php
require_once "../core/session.php";
require_once "../include/db.php";
require_once "../models/user.php";

$IDUsuario = VerifySession();
$usuario =  getDataUser($conn, $IDUsuario); 

if (!$usuario) {
    session_destroy();
    redirect("../public/login.php");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $datosUsuario = [
        "Nombre"         => cleanInput($_POST["name"]),
        "SegundoNombre"  => cleanInput($_POST["secondname"]),
        "ApellidoPaterno"=> cleanInput($_POST["flastname"]),
        "ApellidoMaterno"=> cleanInput($_POST["mlastname"]),
        "Correo"         => cleanInput($_POST["email"]),
        "Telefono"       => cleanInput($_POST["telefono"]),
        "IDUsuario"      => $IDUsuario
    ];

    updateUserData($conn, $datosUsuario);

    if ($_SESSION["TipoUsuario"] === "Empleado") {
        $datosEmpleado = [
            "NSS"        => cleanInput($_POST["NSS"]),
            "RFC"        => cleanInput($_POST["RFC"]),
            "CURP"       => cleanInput($_POST["CURP"]),
            "IDEmpleado" => $IDUsuario
        ];
        updateEmpleadoData($conn, $datosEmpleado);
    }

    $_SESSION["Nombre"] = $datosUsuario["Nombre"];
    redirect("../public/profile.php?actualizado=1");
}
?>