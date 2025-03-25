<?php
// Configuración de la base de datos
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = 'serverwow';
$dbName = 'pruebas_random';

// Inicializar variables
$username = '';
$error = '';
$isLoggedIn = false;

// Iniciar sesión
session_start();

// Procesar el formulario de login cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y limpiar datos del formulario
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validaciones básicas
    if (empty($username) || empty($password)) {
        $error = "Por favor, introduce tu nombre de usuario y contraseña.";
    } else {
        try {
            // Conectar a la base de datos
            $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Verificar si el usuario existe
            $stmt = $conn->prepare("SELECT * FROM account WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // Contraseña correcta, establecer sesión
                $_SESSION['username'] = $user['username'];
                $isLoggedIn = true;
            } else {
                $error = "Nombre de usuario o contraseña incorrectos.";
            }
        } catch (PDOException $e) {
            $error = "Error en la base de datos: " . $e->getMessage();
        }
    }
}

// Manejar logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplicación Web Random</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #0a0a0a url('/api/placeholder/1920/1080') no-repeat center center fixed;
            background-size: cover;
            color: #ffffff;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 5px;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }

        h1 {
            text-align: center;
            color: #ffcc00;
            margin-bottom: 30px;
            text-shadow: 0 0 5px #000;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #ffcc00;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: none;
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-radius: 3px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4a6da7;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            width: 100%;
            text-transform: uppercase;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #5c8bd6;
        }

        .error {
            color: #ff6b6b;
            background-color: rgba(255, 0, 0, 0.1);
            padding: 10px;
            border-radius: 3px;
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #999;
        }

        .logged-in-section {
            text-align: center;
            padding: 20px;
        }

        .logout-btn {
            display: inline-block;
            background-color: #ff4444;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 3px;
            margin-top: 20px;
        }

        .logged-in-content {
            background-color: rgba(255, 204, 0, 0.1);
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php if (!$isLoggedIn && !isset($_SESSION['username'])): ?>
            <h1>Iniciar Sesión</h1>

            <?php if (!empty($error)): ?>
                <div class="error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="username">Nombre de Usuario:</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" placeholder="Tu nombre de cuenta">
                </div>

                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" placeholder="Contraseña">
                </div>

                <div class="form-group">
                    <input type="submit" value="Iniciar Sesión">
                </div>
            </form>

            <div class="footer">
                <p>¿No tienes una cuenta? <a href="prueba-registro.php" style="color: #ffcc00;">Regístrate aquí</a></p>
                <p>© 2025 - Restauradores Bercianos - Todos los derechos reservados.</p>
            </div>

        <?php else:
            // Sección de usuario logeado
            $loggedUsername = isset($_SESSION['username']) ? $_SESSION['username'] : $username;
        ?>
            <div class="logged-in-section">
                <h1>¡Bienvenido, <?php echo htmlspecialchars($loggedUsername); ?>!</h1>

                <div class="logged-in-content">
                    <h2>Panel de Usuario</h2>
                    <p>Has iniciado sesión correctamente en la Aplicación Random.</p>
                    <p>Aquí puedes agregar más contenido específico para usuarios registrados.</p>
                </div>

                <a href="?logout=true" class="logout-btn">Cerrar Sesión</a>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>