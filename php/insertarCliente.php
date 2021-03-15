<?php
//Import PHPMailer classes into the global namespace
echo "0";
use PHPMailer\PHPMailer\PHPMailer;
echo "1";
use PHPMailer\PHPMailer\SMTP;
echo "2";
require 'vendor/autoload.php';
echo "3";
require 'cliente.php';
$servername = "localhost";
$username = "php";
$password = "1234";
$database = "pruebas";

$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$DNI = $_POST['DNI'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];

$clienteNuevo = new Cliente($DNI,$nombre,$apellidos,$email,$fecha_nacimiento);

$clienteNuevo->darAlta($conn);

$conn->close();

?>
