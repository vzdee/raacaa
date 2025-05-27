<?php
include "../include/db.php";

function formatDate($dateStr) {
    return $dateStr ? date("d/m/Y", strtotime($dateStr)) : 'N/A';
}

function renderServiciosByCliente($conn, $idCliente) {
    $sql = "SELECT 
                s.IDServicio, 
                se.IDEmpleado, 
                s.CostoEstimado, 
                s.EstadoServicio, 
                s.FechaInicio, 
                s.FechaFinal
            FROM Servicio s
            INNER JOIN Servicio_Cliente sc ON s.IDServicio = sc.IDServicio
            LEFT JOIN Servicio_Empleado se ON s.IDServicio = se.IDServicio
            WHERE sc.IDCliente = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idCliente);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['IDServicio']) . "</td>";
            echo "<td>" . htmlspecialchars($row['IDEmpleado'] ?? 'N/A') . "</td>";
            echo "<td>$" . number_format($row['CostoEstimado'], 2) . "</td>";
            echo "<td>" . htmlspecialchars($row['EstadoServicio']) . "</td>";
            echo "<td>" . formatDate($row['FechaInicio']) . "</td>";
            echo "<td>" . formatDate($row['FechaFinal']) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No hay servicios registrados.</td></tr>";
    }
}

function renderServiciosByEmpleado($conn, $idEmpleado) {
    $sql = "SELECT 
                s.IDServicio, 
                c.IDCliente, 
                s.CostoEstimado, 
                s.EstadoServicio, 
                s.FechaInicio, 
                s.FechaFinal
            FROM Servicio s
            INNER JOIN Servicio_Empleado se ON s.IDServicio = se.IDServicio
            LEFT JOIN Servicio_Cliente sc ON s.IDServicio = sc.IDServicio
            WHERE se.IDEmpleado = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idEmpleado);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['IDServicio']) . "</td>";
            echo "<td>" . htmlspecialchars($row['IDCliente'] ?? 'N/A') . "</td>";
            echo "<td>$" . number_format($row['CostoEstimado'], 2) . "</td>";
            echo "<td>" . htmlspecialchars($row['EstadoServicio']) . "</td>";
            echo "<td>" . formatDate($row['FechaInicio']) . "</td>";
            echo "<td>" . formatDate($row['FechaFinal']) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No hay servicios registrados.</td></tr>";
    }
}

function renderEmpleados($conn) {
    $sql = "SELECT 
                u.IDUsuario,
                u.Nombre, 
                u.SegundoNombre, 
                u.ApellidoPaterno, 
                u.ApellidoMaterno, 
                u.Correo, 
                e.NSS, 
                e.RFC
            FROM Usuario u
            INNER JOIN Empleado e ON u.IDUsuario = e.IDEmpleado
            WHERE u.TipoUsuario = 'Empleado'";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['IDUsuario']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Nombre']) . "</td>";
            echo "<td>" . htmlspecialchars($row['SegundoNombre']) . "</td>";
            echo "<td>" . htmlspecialchars($row['ApellidoPaterno']) . "</td>";
            echo "<td>" . htmlspecialchars($row['ApellidoMaterno']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Correo']) . "</td>";
            echo "<td>" . htmlspecialchars($row['NSS']) . "</td>";
            echo "<td>" . htmlspecialchars($row['RFC']) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No hay empleados registrados.</td></tr>";
    }
}

function renderAllServicios($conn) {
    $sql = "SELECT
                s.IDServicio,
                sc.IDCliente,
                se.IDEmpleado,
                ts.NombreServicio,
                s.CostoEstimado,
                s.EstadoServicio,
                s.FechaInicio,
                s.FechaFinal
            FROM Servicio s
            LEFT JOIN Servicio_Cliente sc ON s.IDServicio = sc.IDServicio
            LEFT JOIN Servicio_Empleado se ON s.IDServicio = se.IDServicio
            INNER JOIN TipoServicio ts ON s.IDTipoServicio = ts.IDTipoServicio
            ORDER BY s.IDServicio";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['IDServicio']) . "</td>";
            echo "<td>" . htmlspecialchars($row['IDCliente'] ?? 'N/A') . "</td>";
            echo "<td>" . htmlspecialchars($row['IDEmpleado'] ?? 'N/A') . "</td>";
            echo "<td>" . htmlspecialchars($row['NombreServicio']) . "</td>";
            echo "<td>$" . number_format($row['CostoEstimado'], 2) . "</td>";
            echo "<td>" . htmlspecialchars($row['EstadoServicio']) . "</td>";
            echo "<td>" . formatDate($row['FechaInicio']) . "</td>";
            echo "<td>" . formatDate($row['FechaFinal']) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No hay servicios registrados.</td></tr>";
    }
}

function renderServicesByStatus($conn, $status) {
    $sql = "SELECT 
            s.IDServicio,
            sc.IDCliente, 
            se.IDEmpleado, 
            ts.NombreServicio, 
            s.CostoEstimado, 
            s.EstadoServicio, 
            s.FechaInicio, 
            s.FechaFinal
        FROM Servicio s
        LEFT JOIN Servicio_Cliente sc ON s.IDServicio = sc.IDServicio
        LEFT JOIN Servicio_Empleado se ON s.IDServicio = se.IDServicio
        INNER JOIN TipoServicio ts ON s.IDTipoServicio = ts.IDTipoServicio
        WHERE s.EstadoServicio = ?
        ORDER BY s.EstadoServicio = 'Pendiente' DESC, s.IDServicio ASC";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "<tr><td colspan='8'>Error al preparar la consulta: " . htmlspecialchars($conn->error) . "</td></tr>";
        return;
    }

    $stmt->bind_param("s", $status);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['IDServicio']) . "</td>";
            echo "<td>" . htmlspecialchars($row['IDCliente'] ?? 'N/A') . "</td>";
            echo "<td>" . htmlspecialchars($row['IDEmpleado'] ?? 'N/A') . "</td>";
            echo "<td>" . htmlspecialchars($row['NombreServicio']) . "</td>";
            echo "<td>$" . number_format((float)$row['CostoEstimado'], 2) . "</td>";
            echo "<td>" . htmlspecialchars($row['EstadoServicio']) . "</td>";
            echo "<td>" . formatDate($row['FechaInicio']) . "</td>";
            echo "<td>" . formatDate($row['FechaFinal']) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No hay servicios con el estado '" . htmlspecialchars($status) . "'.</td></tr>";
    }
}


function insertServices($conn, $idUsuario, $tipoServicioNombre, $fechaDeseada) {
    // Obtener IDTipoServicio a partir del nombre
    $stmtTipo = $conn->prepare("SELECT IDTipoServicio FROM TipoServicio WHERE NombreServicio = ?");
    if (!$stmtTipo) return false;
    $stmtTipo->bind_param("s", $tipoServicioNombre);
    if (!$stmtTipo->execute()) return false;
    $resultTipo = $stmtTipo->get_result();

    if ($resultTipo->num_rows === 0) {
        // Tipo no válido
        return false;
    }

    $tipoServicio = $resultTipo->fetch_assoc()['IDTipoServicio'];

    // Insertar en la tabla Servicio
    $estado = 'Pendiente';
    $costo = 0.00; // Estimación futura
    $fechaFinal = $fechaDeseada; // Por ahora igual a inicio

    $stmtServicio = $conn->prepare("INSERT INTO Servicio (IDTipoServicio, FechaInicio, FechaFinal, CostoEstimado, EstadoServicio) VALUES (?, ?, ?, ?, ?)");
    if (!$stmtServicio) return false;
    $stmtServicio->bind_param("issds", $tipoServicio, $fechaDeseada, $fechaFinal, $costo, $estado);
    if (!$stmtServicio->execute()) return false;

    // Obtener el ID del servicio insertado
    $idServicio = $conn->insert_id;

    // Insertar relación Servicio - Cliente
    $stmtRelacion = $conn->prepare("INSERT INTO Servicio_Cliente (IDServicio, IDCliente) VALUES (?, ?)");
    if (!$stmtRelacion) return false;
    $stmtRelacion->bind_param("ii", $idServicio, $idUsuario);
    if (!$stmtRelacion->execute()) return false;

    return true;
}

?>
