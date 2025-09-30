<?php
include '../db/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ids = $_POST['id'] ?? [];
    $nombres = $_POST['nombre'] ?? [];
    $emails = $_POST['email'] ?? [];
    $role_ids = $_POST['role_id'] ?? [];
    $boton_habilitado_todos = ($_POST['boton_habilitado_todos'] ?? '0') === '1' ? 1 : 0;
    $activos_post = $_POST['activo'] ?? [];

    $rolesResult = $mysqli->query("SELECT * FROM roles");
    $roles = [];
    while ($rowRol = $rolesResult->fetch_assoc()) {
        $roles[$rowRol['id']] = strtolower($rowRol['nombre']);
    }

    foreach ($ids as $index => $id) {
        $id = (int) $id;
        $nombre = $mysqli->real_escape_string($nombres[$index]);
        $email = $mysqli->real_escape_string($emails[$index]);
        $role_id = (int) $role_ids[$index];
        $activo = in_array($id, $activos_post) ? 1 : 0;

        $boton_habilitado = ($roles[$role_id] === 'admin') ? 1 : $boton_habilitado_todos;

        $sql = "UPDATE usuarios SET 
                nombre = '$nombre',
                email = '$email',
                role_id = $role_id,
                boton_habilitado = $boton_habilitado,
                activo = $activo
                WHERE id = $id";

        $mysqli->query($sql);
    }

    header("Location: /oratoria/pages/gestionarUsuarios.php?msg=actualizacion_exitosa");
    exit;
}
?>
