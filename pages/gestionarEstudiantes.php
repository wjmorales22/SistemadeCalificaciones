<?php
include '../db/conexion.php';
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: /oratoria/auth/login.php");
  exit;
}

$result = $mysqli->query("SELECT id, nombre, promedio FROM estudiantes");
if (!$result) {
  die("Error en consulta: " . $mysqli->error);
}

include '../layout/header.php';
?>


<main>
  <?php
  if (isset($_GET['msg']) && $_GET['msg'] === 'actualizacion_exitosa') {
    echo '<div id="mensaje-exito" class="row" style="margin-top:20px;">'
      . '<div class="col s12 m6 offset-m3">'
      . '<div class="card-panel green lighten-4 green-text text-darken-4 center-align" style="transition: opacity 0.5s;">'
      . '<i class="material-icons left">check_circle</i>'
      . 'Actualización exitosa'
      . '</div>'
      . '</div>'
      . '</div>';
  }
  ?>

  <div class="container">
    <div class="container header-container">
      <h4>Gestión de Estudiantes</h4>
      <a class="waves-effect waves-light btn modal-trigger primary-color" href="#modalAgregarEstudiante">
        <i class="material-icons left">add</i> Agregar Estudiante
      </a>
      <!-- Modal para agregar estudiante -->
      <div id="modalAgregarEstudiante" class="modal">
        <div class="modal-content">
          <h4>Agregar Estudiante</h4>
          <form id="formAgregarEstudiante" method="POST" action="../handlers/studentsAdd.php">
            <div class="input-field">
              <input id="nombre" name="nombre" type="text" required>
              <label for="nombre">Nombre</label>
            </div>
            <div class="input-field">
              <input id="promedio" name="promedio" type="number" min="0" max="10" step="0.01">
              <label for="promedio">Promedio (opcional)</label>
            </div>
            <button class="btn waves-effect waves-light" type="submit">
              <i class="material-icons left">save</i> Guardar
            </button>
          </form>
        </div>
        <div class="modal-footer">
          <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
        </div>
      </div>

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

  document.addEventListener('DOMContentLoaded', function () {
    var elems = document.querySelectorAll('.modal');
    M.Modal.init(elems);
  });

  window.addEventListener('DOMContentLoaded', function () {
    var mensaje = document.getElementById('mensaje-exito');
    if (mensaje) {
      setTimeout(function () {
        mensaje.style.opacity = '0';
        setTimeout(function () {
          mensaje.remove();
        }, 500); // Espera la transición
      }, 5000); // 5 segundos
    }
  });
</script>

<?php include '../layout/footer.php'; ?>