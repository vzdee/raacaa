<?php
include "../include/db.php";

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
            echo "<td>" . htmlspecialchars($row['FechaInicio']) . "</td>";
            echo "<td>" . htmlspecialchars($row['FechaFinal']) . "</td>";
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
            echo "<td>" . htmlspecialchars($row['FechaInicio']) . "</td>";
            echo "<td>" . htmlspecialchars($row['FechaFinal']) . "</td>";
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
            echo "<td>" . htmlspecialchars($row['FechaInicio']) . "</td>";
            echo "<td>" . htmlspecialchars($row['FechaFinal']) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No hay servicios registrados.</td></tr>";
    }
}


?>
