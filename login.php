<?php 
include 'conexion.php'; 
session_start();

// Si ya está logueado, redirige
if (isset($_SESSION['user_id'])) {
    header("Location: /oratoria/pages/index.php");
    exit;
}

// Obtener mensaje flash si existe
$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($mysqli->connect_error) {
        die('Error de conexión: ' . $mysqli->connect_error);
    }

    $email = $mysqli->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT u.id, u.nombre, u.password, u.role_id, u.activo, r.nombre AS rol_nombre FROM Usuarios u
              JOIN Roles r ON u.role_id = r.id WHERE u.email = ?";

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if ($user['activo'] == 0) {
            $_SESSION['message'] = "Tu cuenta aún no ha sido activada por el administrador.";
        } else {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['nombre'] = $user['nombre'];
                $_SESSION['role_id'] = $user['role_id'];
                $_SESSION['rol_nombre'] = $user['rol_nombre'];
                // Redirige a la página principal tras login exitoso
                header("Location: /oratoria/pages/index.php");
                exit;
            } else {
                $_SESSION['message'] = "Contraseña incorrecta.";
            }
        }
    } else {
        $_SESSION['message'] = "Usuario no encontrado.";
    }
    $stmt->close();
    $mysqli->close();

    // Redirige para limpiar POST y mostrar mensaje
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
    <link rel="stylesheet" href="css/estilo.css" />
</head>
<body class="blue lighten-3">
    <nav class="nav-extended primary-color">
        <div class="nav-wrapper container">
            <a href="../pages/index.php" class="brand-logo white-text">Oratoria</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="index.php" class="white-text">Inicio</a></li>
                <li><a href="register.php" class="white-text">Registrarse</a></li>
            </ul>
        </div>
    </nav>

    <div class="container" style="margin-top: 5rem; max-width: 400px;">
        <div class="card">
            <div class="card-content">
                <span class="card-title center">Iniciar sesión</span>

                <?php if ($message): ?>
                    <div class="card-panel red lighten-4 red-text text-darken-4 center">
                        <?php echo htmlspecialchars($message); ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="">
                    <div class="input-field">
                        <input id="email" name="email" type="email" class="validate" required autofocus />
                        <label for="email">Correo electrónico</label>
                    </div>
                    <div class="input-field">
                        <input id="password" name="password" type="password" class="validate" required />
                        <label for="password">Contraseña</label>
                    </div>
                    <div class="center">
                        <button class="btn waves-effect waves-light" type="submit">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
