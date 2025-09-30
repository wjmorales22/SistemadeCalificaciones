<?php
include '../db/conexion.php';

$result = $mysqli->query("SELECT id, nombre, promedio FROM estudiantes");
if (!$result) {
  die("Error en consulta: " . $mysqli->error);
}

include '../layout/header.php';
?>

<main>
  <div class="container">
<div class="container header-container">
  <h4>Gestión de Estudiantes</h4>
  <a class="waves-effect waves-light btn modal-trigger primary-color" href="#modalAgregarEstudiante">
    <i class="material-icons left">add</i> Agregar Estudiante
  </a>
</div>


    <form method="POST" action="../handlers/studentsUpdate.php" id="formUsuarios">
      <table class="highlight responsive-table">

        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Promedio</th>
            <th>Eliminar</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td>
                <?php echo htmlspecialchars($row['id']); ?>
                <input type="hidden" name="id[]" value="<?php echo $row['id']; ?>" />
              </td>
              <td>
                <input type="text" name="nombre[]" value="<?php echo htmlspecialchars($row['nombre']); ?>" required />
              </td>
              <td>
                <input type="number" name="promedio[]" value="<?php echo htmlspecialchars($row['promedio']); ?>" min="0"
                  max="10" />
              </td>
              <td>
                <button type="button" style="background:none; border:none; cursor:pointer;" class="btn-delete"
                  data-id="<?php echo $row['id']; ?>" title="Eliminar estudiante">
                  <i class="material-icons red-text">delete</i>
                </button>
              </td>

            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>

      <br />
      <button class="btn waves-effect waves-light" type="submit"><i class="material-icons left">save</i> Guardar
</button>
    </form>
  </div>
</main>

<script>
  document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', function () {
      if (confirm('¿Seguro que quieres eliminar este estudiante?')) {
        const id = this.getAttribute('data-id');
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '../handlers/studentsDelete.php';
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'id';
        input.value = id;
        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
      }
    });
  });
</script>

<?php include '../layout/footer.php'; ?>
