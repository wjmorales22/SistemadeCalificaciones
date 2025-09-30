<?php
// Datos de conexión
$servername = "localhost";
$username = "root";       // Usuario MySQL en XAMPP normalmente es 'root'
$password = "";           // Contraseña vacía por defecto en XAMPP
$dbname = "sistema_calificacion";  // Cambia al nombre de tu base de datos

// Crear conexión
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($mysqli->connect_error) {
    die("Error en la conexión a la base de datos: " . $mysqli->connect_error);
}
// Aquí puedes agregar otras configuraciones si quieres
?>
