<?php
//opcional: recibir el nombre del usuario por url
//pista: añadir el parametro como parametro opcional de la url(nombre del fichero) en la función header("Location: ...")
$usuario =  $_GET['usuario'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>6_Formularios: 3.Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background: #0a0a0a;
            background-size: cover;
            color: #ffffff;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #ffcc00;
            margin-bottom: 30px;
            text-shadow: 0 0 5px #000;
        }

        a {
            color: red;
        }
    </style>
</head>

<body>

    <h1>Bienvenid@ usuario: <?= htmlspecialchars($usuario) ?></h1>

    <!-- aquí va el formulario de login con usuario(text) y contraseña(password) -->
    <a href="./index.html">🔙 Volver al formulario</a>
</body>

</html>