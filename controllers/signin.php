<?php
require_once "../core/auth.php";
require_once "../core/session.php";
require_once "../core/helpers.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = cleanInput($_POST["email"]);
    $contrasena = cleanInput($_POST["password"]);
    
    $resultado = loginUser($correo, $contrasena);

    if (isset($resultado["error"])) {
        echo $resultado["error"];
    } else {
        session_start();
        $_SESSION["IDUsuario"] = $resultado["IDUsuario"];
        $_SESSION["TipoUsuario"] = $resultado["TipoUsuario"];

        switch ($resultado["TipoUsuario"]) {
            case 'Admin':
                redirect("../public/panel.php");
                break;
            case 'Empleado':
            case 'Cliente':
                redirect("../public/profile.php");
                break;
            default:
                echo "Rol no reconocido.";
        }
    }
}
?>
