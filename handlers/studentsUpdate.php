<?php
include '../db/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ids = $_POST['id'] ?? [];
    $nombres = $_POST['nombre'] ?? [];
    $promedios = $_POST['promedio'] ?? [];

    if (count($ids) !== count($nombres) || count($nombres) !== count($promedios)) {
        die("Los datos enviados no tienen la misma cantidad de elementos");
    }

    $stmt = $mysqli->prepare("UPDATE estudiantes SET nombre = ?, promedio = ? WHERE id = ?");
    if (!$stmt) {
        die("Error en preparación de consulta: " . $mysqli->error);
    }

    foreach ($ids as $index => $id) {
        $id = (int)$id;
        $nombre = trim($nombres[$index]);
        $promedio = is_numeric($promedios[$index]) ? (int)$promedios[$index] : null;

        $stmt->bind_param('sii', $nombre, $promedio, $id);
        $stmt->execute();
        if ($stmt->error) {
            die("Error en ejecución de consulta: " . $stmt->error);
        }
    }

    $stmt->close();

    header("Location: /oratoria/pages/gestionarEstudiantes.php?msg=actualizacion_exitosa");
    exit;
}
?>
