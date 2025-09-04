<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sidebar fijo con Materialize</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css" />
  <style>
    main, header, footer {
      padding-left: 300px; /* espacio para el sidebar fijo */
    }
    @media only screen and (max-width: 992px) {
      main, header, footer {
        padding-left: 0; /* en móvil quitar padding */
      }
    }
  </style>
</head>
<body>
<div class="container">
  <div class="row">
    <!-- Sidebar: ocupa 3 columnas en desktop -->
    <div class="col s12 m3 l3">
      <ul class="sidenav sidenav-fixed">
        <li><a href="#!">Nombre 1</a></li>
        <li><a href="#!">Nombre 2</a></li>
        <li><a href="#!">Nombre 3</a></li>
        <li><a href="#!">Nombre 4</a></li>
      </ul>
    </div>

    <!-- Contenido principal: ocupa 9 columnas -->
    <div class="col s12 m9 l9">
      <!-- Aquí va tu contenido principal, formulario, etc -->
      <h4>Contenido principal</h4>
      <p>Formulario, resultados, etc.</p>
    </div>
  </div>
</div>

  