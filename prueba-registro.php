<?php
// Configuración de la base de datos
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = 'serverwow';
$dbName = 'pruebas_random';

// Inicializar variables
$username = $password = $email = '';
$error = '';
$success = '';

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y limpiar datos del formulario
    $username = strtoupper(trim($_POST['username']));
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);

    // Validaciones básicas
    if (empty($username) || empty($password) || empty($email)) {
        $error = "Todos los campos son obligatorios.";
    } elseif (strlen($username) < 3 || strlen($username) > 32) {
        $error = "El nombre de usuario debe tener entre 3 y 32 caracteres.";
    } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $error = "El nombre de usuario solo puede contener letras y números.";
    } elseif (strlen($password) < 8) {
        $error = "La contraseña debe tener al menos 8 caracteres.";
    } elseif (!preg_match("/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/", $password)) {
        $error = "La contraseña debe tener al menos una mayúscula, un número y un carácter especial.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Por favor, introduce un email válido.";
    } elseif (strpos($email, ' ') !== false) {
        $error = "El email no debe contener espacios.";
    } else {
        try {
            // Conectar a la base de datos
            $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Verificar si el usuario ya existe
            $stmt = $conn->prepare("SELECT 1 FROM account WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            if ($stmt->fetchColumn()) {
                $error = "Este nombre de usuario ya está en uso.";
            } else {
                // Verificar si el email ya existe
                $stmt = $conn->prepare("SELECT 1 FROM account WHERE email = :email");
                $stmt->bindParam(':email', $email);
                $stmt->execute();

                if ($stmt->fetchColumn()) {
                    $error = "Este email ya está en uso.";
                } else {
                    // Hashear la contraseña
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    // Insertar nueva cuenta con la contraseña encriptada
                    $stmt = $conn->prepare("INSERT INTO account (username, email, reg_mail, password, join_date) 
                    VALUES (:username, :email, :reg_mail, :password, NOW())");
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':reg_mail', $email);
                    $stmt->bindParam(':password', $hashedPassword);
                    $stmt->execute();

                    $success = "¡Cuenta creada con éxito! Ya puedes iniciar sesión.";
                    // Limpiar los campos después del registro exitoso
                    $username = $password = $email = '';
                }
            }
        } catch (PDOException $e) {
            error_log("Error en la base de datos: " . $e->getMessage()); // Log para el administrador
            $error = "Hubo un error al procesar tu solicitud. Por favor, inténtalo más tarde.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Aplicación Web Random</title>
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
        input[type="password"],
        input[type="email"] {
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

        .success {
            color: #6bff6b;
            background-color: rgba(0, 255, 0, 0.1);
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

        .instructions {
            background-color: rgba(255, 204, 0, 0.1);
            padding: 15px;
            border-radius: 3px;
            margin-bottom: 20px;
            border-left: 3px solid #ffcc00;
        }

        /* Logo estilizado */
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo h2 {
            font-family: "Times New Roman", serif;
            font-size: 32px;
            color: #ffcc00;
            text-shadow: 0 0 10px #4a6da7;
            margin: 0;
            letter-spacing: 2px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Registro de Cuenta - Aplicación Random</h1>

        <div class="instructions">
            <p>Bienvenido a nuestra nueva Aplicación Web</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="username">Nombre de Usuario:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" placeholder="Tu nombre de cuenta">
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" placeholder="Mínimo 8 caracteres">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="email@ejemplo.com">
            </div>

            <div class="form-group">
                <input type="submit" value="Crear Cuenta">
            </div>
        </form>

        <div class="footer">
            <p><a href="prueba-login.php" style="color: #ffcc00;">Login</a></p>
            <p>Recuerda: Nunca compartas tu contraseña con nadie.</p>
            <p>© 2025 - Restauradores Bercianos - Todos los derechos reservados.</p>
        </div>
    </div>
</body>

</html>