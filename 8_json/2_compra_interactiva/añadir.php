<?php

$fileJson = 'compra.json';

// Verificar si es una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Leer y decodificar el JSON antes de usarlo
    $array = json_decode(file_get_contents($fileJson), true);
    //Si presiono el botón de borrar
    if (isset($_POST['submit-borrar'])) {

        // Si el array no está vacío, eliminar el último elemento
        if (!empty($array)) {
            array_pop($array);
            file_put_contents($fileJson, json_encode($array), JSON_PRETTY_PRINT);
        }

        //Si no están vacíos los campos de producto y precio los añado en las variables $producto y $precio
    } elseif (!empty($_POST['input-producto']) && !empty($_POST['input-precio'])) {
        $producto = htmlspecialchars(trim($_POST['input-producto']));
        $precio = htmlspecialchars(trim($_POST['input-precio']));

        // Agregar el nuevo producto al array ($producto en producto y $precio en precio)
        $array[] = [
            'producto' => $producto,
            'precio' => $precio
        ];

        // Guardar los datos actualizados en el JSON
        file_put_contents($fileJson, json_encode($array),JSON_PRETTY_PRINT);
    } else {
        echo "<script>alert('Faltan datos.')</script>";
    }

    // Redirigir a index.php
    header("Location: index.php");
    exit;
}
