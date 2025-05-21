document.addEventListener("DOMContentLoaded", function() {
    const loginBtn = document.getElementById("loginBtn");
    const registerBtn = document.getElementById("registerBtn");

    const loginForm = document.querySelector(".form-login");
    const registerForm = document.querySelector(".form-register");

    if (loginBtn && registerBtn && loginForm && registerForm) {
        // Mostrar formulario de login y ocultar el de registro
        loginBtn.addEventListener("click", function() {
            loginForm.style.display = "block";
            registerForm.style.display = "none";
        });

        // Mostrar formulario de registro y ocultar el de login
        registerBtn.addEventListener("click", function() {
            loginForm.style.display = "none";
            registerForm.style.display = "block";
        });
    }
});

//esconde elementos del menu dependiendo del rol
document.addEventListener("DOMContentLoaded", function () {
    const rol = "<?php echo $_SESSION['Rol'] ?? ''; ?>";

    if (rol !== 'Cliente') {
        document.querySelectorAll('.menu-cliente').forEach(el => el.style.display = 'none');
    }
    if (rol !== 'Empleado') {
        document.querySelectorAll('.menu-empleado').forEach(el => el.style.display = 'none');
    }
    if (rol !== 'Administrador') {
        document.querySelectorAll('.menu-admin').forEach(el => el.style.display = 'none');
    }
});
