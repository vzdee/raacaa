<?php

// --- READ ---
function findUserByEmail($conn, $email, $includePassword = true) {
    $select = $includePassword ? "IDUsuario, Contrasena, TipoUsuario" : "IDUsuario";
    $stmt = $conn->prepare("SELECT $select FROM Usuario WHERE Correo = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function getDataUser($conn, $id) {
    $stmt = $conn->prepare("SELECT u.*, e.NSS, e.RFC, e.CURP FROM Usuario u 
                            LEFT JOIN Empleado e ON u.IDUsuario = e.IDEmpleado
                            WHERE u.IDUsuario = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// --- CREATE ---
function insertUser($conn, $data) {
    $stmt = $conn->prepare(
        "INSERT INTO Usuario (Nombre, SegundoNombre, ApellidoPaterno, ApellidoMaterno, Correo, Telefono, TipoUsuario, Contrasena) 
         VALUES (?, ?, ?, ?, ?, ?, 'Cliente', ?)"
    );
    $stmt->bind_param("sssssss",
        $data['name'],
        $data['secondname'],
        $data['Flastname'],
        $data['Mlastname'],
        $data['email'],
        $data['telefono'],
        $data['password']
    );
    return $stmt->execute() ? $conn->insert_id : false;
}

function insertCliente($conn, $userId) {
    $stmt = $conn->prepare("INSERT INTO Cliente (IDCliente) VALUES (?)");
    $stmt->bind_param("i", $userId);
    return $stmt->execute();
}


// --- UPDATE ---
function updateUserData($conn, $datos) {
    $stmt = $conn->prepare(
        "UPDATE Usuario 
         SET Nombre = ?, SegundoNombre = ?, ApellidoPaterno = ?, ApellidoMaterno = ?, Correo = ?, Telefono = ? 
         WHERE IDUsuario = ?"
    );
    $stmt->bind_param("ssssssi", 
        $datos["Nombre"], 
        $datos["SegundoNombre"], 
        $datos["ApellidoPaterno"], 
        $datos["ApellidoMaterno"], 
        $datos["Correo"], 
        $datos["Telefono"], 
        $datos["IDUsuario"]
    );
    return $stmt->execute();
}

function updateEmpleadoData($conn, $datos) {
    $stmt = $conn->prepare(
        "UPDATE Empleado 
         SET NSS = ?, RFC = ?, CURP = ? 
         WHERE IDEmpleado = ?"
    );
    $stmt->bind_param("sssi", 
        $datos["NSS"], 
        $datos["RFC"], 
        $datos["CURP"], 
        $datos["IDEmpleado"]
    );
    return $stmt->execute();
}
?>
