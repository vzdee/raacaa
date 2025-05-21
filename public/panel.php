<?php
include '../views/panelheader.php';
require_once "../models/services.php";

?>
<title>Dashboard | RAACAA </title>
<div class="container">

    <div class="table-empleados">
        <h1>Lista Empleados</h1>
        <div class="box">
            <table>
                <thead>
                    <tr>
                        <th># Empleado</th>
                        <th>Nombre</th>
                        <th>Segundo Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Correo</th>
                        <th>NSS</th>
                        <th>RFC</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    renderEmpleados($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="table-services">
        <h1>Lista Servicios</h1>
        <div class="box">
            <table>
                <thead>
                    <tr>
                        <th># Servicio</th>
                        <th># Cliente</th>
                        <th># Empleado</th>
                        <th>Tipo Servicio</th>
                        <th>Costo</th>
                        <th>Estado</th>
                        <th>Fecha Inicial</th>
                        <th>Fecha Final</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    renderAllServicios($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
</body>
</html>

