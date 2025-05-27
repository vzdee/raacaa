<?php
require_once "../include/db.php";
require_once "../models/services.php";
require_once "../core/session.php"; // <--- incluir para sesiones

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tipoServicio = $_POST["TipoServicio"] ?? '';
    $fechaDeseada = $_POST["date"] ?? '';

    $idUsuario = verifySession(); // <--- obtener IDUsuario desde la sesión

    if (!empty($tipoServicio) && !empty($fechaDeseada) && !empty($idUsuario)) {
        // Inserta el servicio en base a la lógica que definas
        $success = insertServices($conn, $idUsuario, $tipoServicio, $fechaDeseada);

        if ($success) {
            header("Location: ../public/services.php?success=1");
            exit();
        } else {
            header("Location: ../public/services.php?error=2"); // error inserción
            exit();
        }
    } else {
        header("Location: ../public/services.php?error=1"); // error validación
        exit();
    }
} else {
    header("Location: ../public/services.php");
    exit();
}
?>
