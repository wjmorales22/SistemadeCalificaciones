<?php
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mysqli = new mysqli('localhost', 'root', '', 'sistema_calificacion');
    if ($mysqli->connect_error) {
        die('Error de conexión: ' . $mysqli->connect_error);
    }

    $nombre = $mysqli->real_escape_string($_POST['nombre']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    if (empty($nombre) || empty($email) || empty($password)) {
        $message = 'Por favor llene todos los campos.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Correo electrónico no válido.';
    } else {
        $stmt = $mysqli->prepare("SELECT id FROM Usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $message = "Ya existe un usuario registrado con ese correo.";
        } else {
            $stmt->close();
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $role_id = 2; // Calificador por defecto
            $activo = 0;  // Inactivo hasta que admin lo active

            $stmt = $mysqli->prepare("INSERT INTO Usuarios (nombre, email, password, role_id, activo) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssii", $nombre, $email, $password_hash, $role_id, $activo);

            if ($stmt->execute()) {
                $message = "Registro exitoso. Debes esperar a que el administrador active tu cuenta.";
            } else {
                $message = "Error al registrar usuario. Intenta de nuevo.";
            }
            $stmt->close();
        }
    }

    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Registro de usuario</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/estilo.css">
</head>

<body class="blue lighten-5">
    <nav class="nav-extended primary-color">
        <div class="nav-wrapper container">
            <a href="../pages/index.php" class="brand-logo white-text">Oratoria</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="index.php" class="white-text">Inicio</a></li>
            </ul>
        </div>
    </nav>

    <div class="container" style="margin-top: 5rem; max-width: 500px;">
        <div class="card">
            <div class="card-content">
                <span class="card-title center">Registro de usuario</span>

                <?php if ($message): ?>
                    <div class="card-panel green lighten-4 green-text text-darken-4 center">
                        <?php echo htmlspecialchars($message); ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="">
                    <div class="input-field">
                        <input id="nombre" name="nombre" type="text" required>
                        <label for="nombre">Nombre completo</label>
                    </div>
                    <div class="input-field">
                        <input id="email" name="email" type="email" required>
                        <label for="email">Correo electrónico</label>
                    </div>
                    <div class="input-field">
                        <input id="password" name="password" type="password" required>
                        <label for="password">Contraseña</label>
                    </div>

                    <div class="center">
                        <button class="btn waves-effect waves-light" type="submit">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>