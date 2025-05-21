<?php
require_once "../core/session.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/media/css/panel.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="../public/media/js/tabs.js" defer></script>
</head>
<body>
    <header>
        <div class="wrap">
            <p class="logo"> RAACAA </p>
            <nav>
                
                <?php if (isAdmin()): ?>
                <a href="../public/panel.php">Dashboard</a>
                <a href="../public/manager.php">Manage</a>
                <?php endif; ?>
                <?php if (isEmpleado()): ?>
                <a href="../controllers/.php">Manage Services</a>
                <?php endif; ?>

                <a href="../public/services.php">My Services</a>
                <a href="../public/profile.php">Profile</a>
                <a href="../controllers/logout.php">Log out</a>

            </nav>
        </div>
    </header>

