<?php 
include '../views/panelheader.php';
include '../controllers/profile.php';
?>
<title>Profile | RAACAA </title>
    <div class="profile-container">
        <div class="contenedor">
            <h1>Perfil de Usuario</h1>
            <div class="profile-rol">
                <p><strong>Rol:</strong> <?= htmlspecialchars($usuario["TipoUsuario"] ?? 'Unknow') ?></p>
                <p><strong>ID Cuenta:</strong> <?= htmlspecialchars($usuario["IDUsuario"] ?? 'Unknow') ?> </p>
            </div>
            <form class="form-section" method="POST" action="">
                <fieldset>
                    <legend>Información Personal</legend>
                    <div class="profile-grid">
                    <div class="input-group">
                        <label for="firstname">Nombre</label>
                        <input type="text" id="firstname" name="name" placeholder="Nombre" required
       value="<?= htmlspecialchars($usuario['Nombre'] ?? '') ?>">
                    </div>

                    <div class="input-group">
                        <label for="secondname">Segundo Nombre</label>
                        <input type="text" id="secondname" name="secondname" placeholder="Segundo Nombre" required
       value="<?= htmlspecialchars($usuario['SegundoNombre'] ?? '') ?>">
                    </div>

                    <div class="input-group">
                        <label for="Flastname">Apellido Paterno</label>
                        <input type="text" id="Flastname" name="flastname" placeholder="Apellido Paterno" required
       value="<?= htmlspecialchars($usuario['ApellidoPaterno'] ?? '') ?>">
                    </div>

                    <div class="input-group">
                        <label for="Mlastname">Apellido Materno</label>
                        <input type="text" id="Mlastname" name="mlastname" placeholder="Apellido Materno" required
       value="<?= htmlspecialchars($usuario['ApellidoMaterno'] ?? '') ?>">
                    </div>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Contacto y Datos Fiscales</legend>
                    <div class="profile-grid">
                    <div class="input-group">
                        <label for="email">Correo</label>
                        <input type="email" id="email" name="email" placeholder="Correo Electrónico" required
       value="<?= htmlspecialchars($usuario['Correo'] ?? '') ?>">
                    </div>

                    <div class="input-group">
                        <label for="telefono">Teléfono</label>
                        <input type="tel" id="telefono" name="telefono" placeholder="Teléfono" required
       value="<?= htmlspecialchars($usuario['Telefono'] ?? '') ?>">
                    </div>

                    <?php if ($usuario["TipoUsuario"] === "Admin" || $usuario["TipoUsuario"] === "Empleado"): ?>
                    <div class="input-group">
                        <label for="NSS">NSS</label>
                        <input type="text" id="NSS" name="NSS" placeholder="Número de Seguro Social" required
                            value="<?= htmlspecialchars($usuario['NSS'] ?? '') ?>">
                    </div>

                    <div class="input-group">
                        <label for="RFC">RFC</label>
                        <input type="text" id="RFC" name="RFC" placeholder="RFC" required
                            value="<?= htmlspecialchars($usuario['RFC'] ?? '') ?>">
                    </div>
                    
                    <div class="input-group">
                        <label for="CURP">CURP</label>
                        <input type="text" id="CURP" name="CURP" placeholder="CURP" required
                            value="<?= htmlspecialchars($usuario['CURP'] ?? '') ?>">
                    </div>
                    </div>
                    <?php endif; ?>
                </fieldset>
                <div class="button-container">
                    <button type="submit">Actualizar Datos</button>
                </div>
            </form>
        </div>
    </div>
 </body>
</html>
