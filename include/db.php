<?php
// include/db.php
$host = "localhost";
$dbname = "raacaas";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Failed to connect: " . $conn->connect_error);
}
?>
