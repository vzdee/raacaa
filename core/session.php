<?php
require_once "helpers.php";

// Asegura que la sesión esté iniciada una vez
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function verifySession() {
    if (!isset($_SESSION["IDUsuario"])) {
        redirect("../public/sign.php");
    }

    return $_SESSION["IDUsuario"];
}

function isAdmin() {
    return isset($_SESSION["TipoUsuario"]) && $_SESSION["TipoUsuario"] === "Admin";
}

function isEmpleado() {
    return isset($_SESSION["TipoUsuario"]) && $_SESSION["TipoUsuario"] === "Empleado";
}

function isCliente() {
    return isset($_SESSION["TipoUsuario"]) && $_SESSION["TipoUsuario"] === "Cliente";
}

function isLoggedIn() {
    return isset($_SESSION["IDUsuario"]);
}
