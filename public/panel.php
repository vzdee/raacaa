<?php
include '../views/panelheader.php';
require_once "../models/services.php";

?>

<title>Panel | RAACAA </title>
  <div class="profile-container">
    <div class="sections">
      <button class="tab-button active" onclick="mostrarContenedor('showservices', this)">Lista de Servicio</button>
      <button class="tab-button" onclick="mostrarContenedor('serviciospendientes', this)">Servicios Pendientes</button>
      <button class="tab-button" onclick="mostrarContenedor('listaempleados', this)">Lista de Empleados</button>
    </div>

    <div id="showservices" class="contenedor">
      <div class="table-services">
        <h1>Historial De Servicios</h1>
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

  <div id="serviciospendientes" class="contenedor hidden">
    <div class="table-services">
        <h1>Servicios Pendientes</h1>
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
                    renderServicesByStatus($conn, "Pendiente");
                    ?>
                </tbody>
          </table>
        </div>
    </div>
  </div>

  <div id="listaempleados" class="contenedor hidden">
    <div class="table-services">
        <h1>Lista Empleados</h1>
        <div class="box">
          <table>
            <thead>
              <tr>
                <th>#Empleado</th>
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
  </div>
</body>
</html>

