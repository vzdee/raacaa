<?php
include "../views/panelheader.php";
require_once "../models/services.php";
require_once "../core/session.php";
?>
  <title>Mis Servicios | RAACAA</title>
  <div class="profile-container">
    <div class="sections">
      <button class="tab-button active" onclick="mostrarContenedor('showservices', this)">Mis Servicio</button>
      <button class="tab-button" onclick="mostrarContenedor('solicitarservicio', this)">Solicitar Servicio</button>
    </div>

    <div id="showservices" class="contenedor">
      <div class="table-services">
        <h1>Historial De Servicios</h1>
        <div class="box">
          <table>
            <thead>
              <tr>
                <th># Servicio</th>
                <th># Empleado</th>
                <th>Costo Estimado</th>
                <th>Estado</th>
                <th>Fecha Inicio</th>
                <th>Fecha Final</th>
              </tr>
            </thead>
            <tbody>
              <?php
                  $idUsuario = verifySession();
                  renderServiciosByCliente($conn, $idUsuario);
              ?>
            </tbody>
          </table>
        </div>
    </div>
  </div>

  <div id="solicitarservicio" class="contenedor hidden">
    <h1>Solicitar Servicio</h1>
    <form class="form-section" method="POST" action="../controllers/services.php">
      <fieldset>
        <legend>Datos del Servicio</legend>
        <div class="input-group">
          <label for="tipo">Tipo de Servicio</label>
          <select id="tipo" name="TipoServicio" required>
            <option value="" disabled selected>Seleccione Un Servicio</option>
            <option value="instalacion">Instalación</option>
            <option value="mantenimiento">Mantenimiento</option>
            <option value="reparacion">Reparación</option>
          </select>
        </div>

        <div class="input-group">
          <label for="fecha">Fecha Deseada</label>
          <input type="date" id="fecha" name="date" required>
        </div>
        
        <div class="button-container">
          <button type="submit">Solicitar Servicio</button>
        </div>
      </fieldset>
    </form>
  </div>  
</body>
</html>