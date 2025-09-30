<?php
include '../db/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nombre = trim($_POST['nombre']);
  $promedio = isset($_POST['promedio']) && $_POST['promedio'] !== '' ? $_POST['promedio'] : null;

  if ($nombre !== '') {
    $stmt = $mysqli->prepare("INSERT INTO estudiantes (nombre, promedio) VALUES (?, ?)");
    $stmt->bind_param('sd', $nombre, $promedio);
    $stmt->execute();
    $stmt->close();
  }
}
header('Location: ../pages/gestionarEstudiantes.php'); 
exit;
?>
