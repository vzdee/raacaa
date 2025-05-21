<?php
include "../views/panelheader.php";
require_once "../core/session.php";
require_once "../models/services.php";

if (!isAdmin()) {
    redirect("../views/unauthorized.php");
}
?>

<title>Manage Employers | RAACAA</title>
  <div class="profile-container">
    <div class="sections">
      <button class="tab-button active" onclick="mostrarContenedor('showempleados', this)">Mostrar Empleados</button>
      <button class="tab-button" onclick="mostrarContenedor('afiliarempleado', this)">Afiliar Empleado</button>
      <button class="tab-button" onclick="mostrarContenedor('bajaempleado', this)">Baja Empleado</button>
    </div>

    <div id="showempleados" class="contenedor">
      <div class="table-empleados">
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

  <div id="afiliarempleado" class="contenedor hidden">
    <h1>Afiliar Empleado</h1>
    <form class="form-section" method="POST" action="">
      <fieldset>
        <legend>Información Personal</legend>
        <div class="profile-grid">
          <div class="input-group">
            <label for="name">Nombre</label>
            <input type="text" id="firstname" name="firstname" placeholder="Nombre" required>
          </div>

          <div class="input-group">
            <label for="secondname">Segundo Nombre</label>
            <input type="text" id="secondname" name="secondname" placeholder="Segundo Nombre" required>
          </div>

          <div class="input-group">
            <label for="Flastname">Apellido Paterno</label>
            <input type="text" id="Flastname" name="Flastname" placeholder="Apellido Paterno" required>
          </div>

          <div class="input-group">
            <label for="Mlastname">Apellido Materno</label>
            <input type="text" id="Mlastname" name="Mlastname" placeholder="Apellido Materno" required>
          </div>
        </div>
      </fieldset>

      <fieldset>
        <legend>Contacto y Datos Fiscales</legend>
        <div class="profile-grid">
          <div class="input-group">
            <label for="email">Correo</label>
            <input type="email" id="email" name="email" placeholder="Correo Electrónico" required>
          </div>

          <div class="input-group">
            <label for="telefono">Teléfono</label>
            <input type="tel" id="telefono" name="telefono" placeholder="Teléfono" required>
          </div>

          <div class="input-group">
            <label for="NSS">NSS</label>
            <input type="text" id="NSS" name="NSS" placeholder="Número de Seguro Social" required>
          </div>

          <div class="input-group">
            <label for="RFC">RFC</label>
            <input type="text" id="RFC" name="RFC" placeholder="Registro Federal de Contribuyentes" required>
          </div>

          <div class="input-group">
            <label for="CURP">CURP</label>
            <input type="text" id="CURP" name="CURP" placeholder="Clave Unica de Registro de Poblacion" required>
          </div>
        </div>
      </fieldset>

      <div class="button-container">
        <button type="submit">Afilia Empleado</button>
      </div>
    </form>
  </div>

    <div id="bajaempleado" class="contenedor hidden">        
        <h1>Baja de Empleados</h1>
        <div class="box">
            <table>
            <thead>
                <tr>
                <th>#</th>
                <th>Nombre Completo</th>
                <th>RFC</th>
                <th>Acción</th>
                </tr>
            </thead>
            <tbody id="baja-lista">
                <!-- Aquí se insertarán los empleados desde PHP -->
                <?php
                $seccion = 'bajaempleado';
                
                ?>
            </tbody>
            </table>
        </div>
    </div>
  </div>
</body>
</html>