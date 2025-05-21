<?php 
include '../views/homeheader.php'; 
?>
<title>Log in | RAACAA </title>
<section id="access">
    <div class="form-toggle">
        <button id="loginBtn">Iniciar sesión</button>
        <button id="registerBtn">Registrar cuenta</button>
    </div>

    <div class="form-login">
        <h2>Iniciar sesión</h2>
        <form action="../controllers/signin.php" method="POST">
            <input type="email" name="email" placeholder="Correo Electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Iniciar sesión</button>
        </form>
    </div>

    <div class="form-register" style="display:none;">
        <h2>Registrar cuenta</h2>
        <form action="../controllers/signup.php" method="POST">
            <input type="text" name="name" placeholder="Nombre" required>
            <input type="text" name="secondname" placeholder="Segundo Nombre" required>
            <input type="text" name="Flastname" placeholder="Apellido Paterno" required>
            <input type="text" name="Mlastname" placeholder="Apellido Materno" required>
            <input type="email" name="email" placeholder="Correo Electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="tel" name="telefono" placeholder=" Numero de Telefono" required>
            <button type="submit">Registrar</button>
        </form>
    </div>
</section>
</body>
</html>
