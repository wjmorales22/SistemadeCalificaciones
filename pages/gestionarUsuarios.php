<?php
include '../db/conexion.php';
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: /oratoria/auth/login.php");
  exit;
}

$result = $mysqli->query("SELECT * FROM usuarios");
if (!$result) {
  die("Error en consulta: " . $mysqli->error);
}
$rolesResult = $mysqli->query("SELECT * FROM roles");
if (!$rolesResult) {
  die("Error en consulta roles: " . $mysqli->error);
}
$roles = [];
while ($rowRol = $rolesResult->fetch_assoc()) {
  $roles[$rowRol['id']] = $rowRol['nombre'];
}

$botonGlobalActivo = true;
while ($rowCheck = $result->fetch_assoc()) {
  $rolName = strtolower($roles[$rowCheck['role_id']] ?? '');
  if ($rolName !== 'admin' && !$rowCheck['boton_habilitado']) {
    $botonGlobalActivo = false;
    break;
  }
}
$result->data_seek(0);

include '../layout/header.php';
?>

<style>
  .chip.selected {
    background-color: #01a08e;
    color: white;
  }

  .chip {
    cursor: pointer;
    user-select: none;
  }

  .chips-container {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
  }
</style>

<main>
  <div class="container">
    <h4>Gestión de Usuarios</h4>

    <!-- Checkbox global -->
    <p>
      <label>
        <input type="checkbox" id="boton_habilitado_global" <?php echo $botonGlobalActivo ? 'checked' : ''; ?> />
        <span>Activar Respuestas para Todos los Calificadores</span>
      </label>
    </p>

    <form method="POST" action="../handlers/user_update.php" id="formUsuarios">
      <input type="hidden" name="boton_habilitado_todos" id="boton_habilitado_todos_hidden"
        value="<?php echo $botonGlobalActivo ? '1' : '0'; ?>">

      <table class="highlight responsive-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Habilitar Respuestas</th>
            <th>Activo</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td>
                <?php echo htmlspecialchars($row['id']); ?>
                <input type="hidden" name="id[]" value="<?php echo $row['id']; ?>" />
              </td>
              <td><input type="text" name="nombre[]" value="<?php echo htmlspecialchars($row['nombre']); ?>" required />
              </td>
              <td><input type="email" name="email[]" value="<?php echo htmlspecialchars($row['email']); ?>" required />
              </td>
              <td>
                <div class="chips-container" data-user-id="<?php echo $row['id']; ?>">
                  <?php foreach ($roles as $roleId => $roleName): ?>
                    <div class="chip <?php echo ($row['role_id'] == $roleId) ? 'selected' : ''; ?>"
                      data-role-id="<?php echo $roleId; ?>">
                      <?php echo htmlspecialchars($roleName); ?>
                    </div>
                  <?php endforeach; ?>
                </div>
                <input type="hidden" name="role_id[]" value="<?php echo (int) $row['role_id']; ?>"
                  id="role_id_<?php echo $row['id']; ?>" />
              </td>
              <td>
                <?php
                $esAdmin = strtolower($roles[$row['role_id']] ?? '') === 'admin';
                echo $esAdmin ? '(Admin Siempre Activado)' : ($botonGlobalActivo ? 'Activado' : 'Desactivado');
                ?>
              </td>
              <td>
                <label>
                  <input type="checkbox" name="activo[]" value="<?php echo $row['id']; ?>" <?php echo ($row['activo'] ? 'checked' : ''); ?> />
                  <span></span>
                </label>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>

      <br />

      <button class="btn waves-effect waves-light" type="submit"><i class="material-icons left">save</i>
        Guardar</button>
    </form>
  </div>
</main>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const checkboxGlobal = document.getElementById('boton_habilitado_global');
    const hiddenInput = document.getElementById('boton_habilitado_todos_hidden');

    hiddenInput.value = checkboxGlobal.checked ? '1' : '0';

    checkboxGlobal.addEventListener('change', function () {
      hiddenInput.value = this.checked ? '1' : '0';
    });

    document.querySelectorAll('.chips-container').forEach(container => {
      container.addEventListener('click', function (e) {
        if (e.target.classList.contains('chip')) {
          container.querySelectorAll('.chip').forEach(c => c.classList.remove('selected'));
          e.target.classList.add('selected');
          const userId = container.getAttribute('data-user-id');
          const roleId = e.target.getAttribute('data-role-id');
          const hiddenInputRole = document.getElementById('role_id_' + userId);
          if (hiddenInputRole) hiddenInputRole.value = roleId;
        }
      });
    });
  });
</script>

<?php include '../layout/footer.php'; ?>