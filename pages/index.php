<?php include '../layout/header.php';
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: /oratoria/login.php");
  exit;
}
if ($_SESSION['role_id'] == 1) {
  $mensaje = "Bienvenido admin " . htmlspecialchars($_SESSION['nombre']);
} elseif ($_SESSION['role_id'] == 2) {
  $mensaje = "Bienvenido calificador " . htmlspecialchars($_SESSION['nombre']);
} else {
  die("Acceso denegado.");
}
?>
<main>
  <div class="container" style="margin-top: 3rem;">
    <h4>Bienvenido <?php echo htmlspecialchars($_SESSION['nombre']); ?></h4>
    <div class="row">
      <?php if ($_SESSION['role_id'] == 1): // Solo admin ?>
        <div class="row">
          <a href="/oratoria/pages/dashboard.php" class="btn primary-color white-text">Ir a Dashboard</a>
        </div>
        <div class="row">
          <a href="gestionarUsuarios.php" class="waves-effect waves-light btn primary-color white-text">Gestionar usuarios</a>
          <a href="#estudiantes.php" class="waves-effect waves-light btn primary-color white-text">Gestionar estudiantes y
            notas</a>
        </div>
      <?php endif; ?>
      <div class="row">
        <a href="#usuarios.php" class="waves-effect waves-light btn primary-color white-text">Ver estudiantes</a>
        <a href="#estudiantes.php" class="waves-effect waves-light btn primary-color white-text">Calificar</a>
        <a href="#estudiantes.php" class="waves-effect waves-light btn primary-color white-text">Ver Calificaciones</a>
      </div>
    </div>
  </div>
</main>


<?php include '../layout/footer.php'; ?>