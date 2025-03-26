<?php


// comprobar si los valores recibidos del formulario coinciden con los siguientes:
$user = 'admin';
$password = '$uper$ecr3t';



// si coinciden, redirigir a la página de bienvenida
// sino, redirigir a la página de error
// pista: la función header('Location: nombre_del_fichero.extension') sirve para redirigir

// Comprobar si se han enviado credenciales
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $get_username = trim(htmlspecialchars($_POST['username']));
    $get_password = trim($_POST['password']);

    // Validar credenciales
    if ($get_username === $user && $get_password === $password) {
        // Redirigir a página de bienvenida con nombre de usuario
        header("Location: bienvenida.php?usuario=" . urlencode($get_username));
        die();
    } else {
        // Redirigir a página de error
        header("Location: error.html");
        die();
    }
}
