<?php
include '../db/conexion.php';
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: /oratoria/auth/login.php");
  exit;
}

include '../layout/header.php';

?>
<main>
    <p>RESULTADOS</p>
</main>

<?php include '../layout/footer.php';?>