<?php
include '../db/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    if ($id > 0) {
        $stmt = $mysqli->prepare("DELETE FROM estudiantes WHERE id = ?");
        if (!$stmt) {
            die("Error en preparación de consulta: " . $mysqli->error);
        }
        $stmt->bind_param('i', $id);
        $stmt->execute();
        if ($stmt->error) {
            die("Error en ejecución de consulta: " . $stmt->error);
        }
        $stmt->close();
    }
    header("Location: /oratoria/pages/gestionarEstudiantes.php?msg=eliminacion_exitosa");
    exit;
}
?>
