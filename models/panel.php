<?php
require_once '../include/db.php'; // Asegúrate de tener conexión a tu BD aquí

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $nombre = $_POST['firstname'];
    $segundoNombre = $_POST['secondname'];
    $apellidoPaterno = $_POST['Flastname'];
    $apellidoMaterno = $_POST['Mlastname'];
    $correo = $_POST['email'];
    $telefono = $_POST['telefono'];
    $nss = $_POST['NSS'];
    $rfc = $_POST['RFC'];
    $curp = $_POST['CURP'];

    // Generar contraseña temporal o aleatoria
    $contrasena = password_hash("empleado123", PASSWORD_DEFAULT); // Contraseña inicial segura

    // Conexión a BD (reemplaza esto con tu método preferido)
    $conn = new mysqli("localhost", "root", "", "raacaas");
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Insertar en Usuario
    $stmt = $conn->prepare("INSERT INTO Usuario 
        (Nombre, SegundoNombre, ApellidoPaterno, ApellidoMaterno, Correo, Telefono, TipoUsuario, Contrasena) 
        VALUES (?, ?, ?, ?, ?, ?, 'Empleado', ?)");
    $stmt->bind_param("sssssss", $nombre, $segundoNombre, $apellidoPaterno, $apellidoMaterno, $correo, $telefono, $contrasena);

    if ($stmt->execute()) {
        $idUsuario = $stmt->insert_id;

        // Insertar en Empleado
        $stmt2 = $conn->prepare("INSERT INTO Empleado (IDEmpleado, NSS, RFC, CURP) VALUES (?, ?, ?, ?)");
        $stmt2->bind_param("isss", $idUsuario, $nss, $rfc, $curp);

        if ($stmt2->execute()) {
            echo " Empleado registrado con éxito.";
        } else {
            echo " Error al registrar en Empleado: " . $stmt2->error;
        }

        $stmt2->close();
    } else {
        echo " Error al registrar usuario: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
