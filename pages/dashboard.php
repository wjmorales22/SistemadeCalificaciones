<?php
session_start();

if ($_SESSION['role_id'] == 1) {
  $mensaje = "Bienvenido admin " . htmlspecialchars($_SESSION['nombre']);
} else {
  die("Acceso denegado.");
}

?>
<?php include '../layout/header.php'; ?>

<main>
  <div class="container" style="margin-top: 3rem;">
    <h4>Dashboard</h4>
    <h4>Manejar Botones</h4>
  </div>
</main>



<?php include '../layout/footer.php'; ?>