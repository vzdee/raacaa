<?php
require_once "../include/db.php";
require_once "../models/user.php";

// Solo verifica y retorna usuario; ya no redirecciona ni maneja sesión.
function loginUser($email, $password) {
    global $conn;
    $user = findUserByEmail($conn, $email);

    if (!$user) return ["error" => "El correo no está registrado."];
    if (!password_verify($password, $user['Contrasena'])) return ["error" => "Contraseña incorrecta."];

    return $user; // Retorna usuario, no hace redirección aquí
}


function registerUser($data) {
    global $conn;

    if (findUserByEmail($conn, $data['email'])) {
        return "Ya existe una cuenta con ese correo.";
    }

    // Encriptar contraseña
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

    $userId = insertUser($conn, $data);
    if (!$userId) return "Error al registrar usuario.";

    if (!insertCliente($conn, $userId)) {
        return "Error al registrar en la tabla Cliente.";
    }

    return true;
}


function logoutUser() {
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../public/sign.php");
    exit;
}
?>
