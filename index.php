<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Oratoria</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/estilo.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        main {
            flex: 1 0 auto;
        }

        .container {
            margin-top: 3rem;
            max-width: 600px;
            text-align: center;
        }

        .primary-color {
            background-color: #01a08e !important;
            color: #ffffff !important;
        }

        .custom-navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            height: 64px;
        }

        .custom-navbar img {
            height: 48px;
        }
    </style>
</head>

<body class="blue lighten-5">
    <div class="custom-navbar primary-color">
        <img src="assets/logo.png" alt="Logo" />
    </div>

    <main>
        <div class="container">
            <h3 class="blue-text text-darken-3">Sistema de Calificación para Oratoria</h3>

            <div class="section">
                <a href="auth/login.php" class="btn-large waves-effect waves-light primary-color">Iniciar Sesión</a>
                <a href="register.php" class="btn-large waves-effect waves-light primary-color">Registrarse</a>
            </div>
        </div>
    </main>

    <footer class="page-footer primary-color">
        <div class="container center">
            © <?php echo date("Y"); ?> Sistema de Calificación
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>