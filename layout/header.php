
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sistema de Calificación</title>
    <!-- Materialize CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css" />
    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/estilo.css">


</head>
<body>

<nav class="primary-color">
  <div class="nav-wrapper container ">
    <a href="../pages/index.php" class="brand-logo white-text">Sistema de Calificación <?php echo date("Y"); ?></a>
    <a href="#" data-target="mobile-menu" class="sidenav-trigger white-text"><i class="material-icons">menu</i></a>
    <ul id="nav-mobile" class="right hide-on-med-and-down">
      <li><a href="../pages/index.php" class="white-text">Inicio</a></li>
      <li><a href="../pages/preguntas.php" class="white-text">Calificar</a></li>
      <li><a href="../pages/resultados.php" class="white-text">Resultados</a></li>
      <li>
        <a class="dropdown-trigger white-text" href="#!" data-target="dropdown1">
          Más opciones<i class="material-icons right">arrow_drop_down</i>
        </a>
      </li>
    </ul>
  </div>

  <!-- Dropdown Structure -->
  <ul id="dropdown1" class="dropdown-content">
    <li class="divider" tabindex="-1"></li>
    <li><a href="#config">Configuración</a></li>
    <li class="divider" tabindex="-1"></li>
    <li><a href="../auth/logout.php">Salir</a></li>
  </ul>
</nav>

<!-- Sidenav para dispositivos móviles -->
<ul class="sidenav" id="mobile-menu">
  <li class="divider" tabindex="-1"></li>
  <li><a href="../pages/index.php" >Inicio</a></li>
  <li><a href="../pages/preguntas.php" >Calificar</a></li>
  <li><a href="#resultados" >Resultados</a></li>
  <li><a href="#perfil">Perfil</a></li>
  <li><a href="#config">Configuración</a></li>
  <li><a href="#salir">Salir</a></li>
</ul>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var elemsDropdown = document.querySelectorAll('.dropdown-trigger');
    M.Dropdown.init(elemsDropdown);

    var elemsSidenav = document.querySelectorAll('.sidenav');
    M.Sidenav.init(elemsSidenav);
  });
</script>
