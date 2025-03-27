
<?php
// Definir el archivo JSON donde se almacenarán los textos
$jsonFile = 'data.json';

// Leer el archivo JSON y decodificar los datos existentes
if (file_exists($jsonFile)) {
    // Decodificar el JSON a un array
    // El segundo parámetro indica que se desea un array asociativo
    // y no un objeto stdClass  (por defecto)
    $texts = json_decode(file_get_contents($jsonFile), true);
} else {
    // Si no existe el archivo, inicializar el array
    // para evitar errores al intentar recorrerlo 
    $texts = [];
}

// Verificar si la solicitud es un POST, si el formulario se ha enviado
// $_SERVER["REQUEST_METHOD"] es una variable superglobal que contiene el método de solicitud   
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se presionó el botón "Borrar Todo"
    if (isset($_POST['borrar-texts'])) {
        // Si se presiona "Borrar Todo", vaciar el JSON
        file_put_contents($jsonFile, json_encode([]));
        $texts = [];
    } else {
        // Obtener y limpiar el texto ingresado
        // trim() para eliminar espacios en blanco al inicio y final
        // ?? '' para asignar un valor por defecto si no se envía el campo  (evita errores)
        $inputText = trim($_POST['input-text'] ?? '');
        
        // Guardar solo si no está vacío
        if (!empty($inputText) && preg_match('/^[a-zA-Z0-9Ñ\s,.-]+$/', $inputText)) {
            // Añadir el texto al array
            // htmlspecialchars() para escapar caracteres especiales
            // ENT_QUOTES para escapar comillas simples y dobles
            // 'UTF-8' para indicar la codificación de caracteres
            $texts[] = htmlspecialchars($inputText, ENT_QUOTES, 'UTF-8');
            // Guardar el array en el archivo JSON
            file_put_contents($jsonFile, json_encode($texts, JSON_PRETTY_PRINT));
        }else{
            echo "<script>alert('El texto ingresado no es válido.')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario con PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: rgba(117, 116, 116, 0.5);
            color: #ffffff;
            margin: 0;
            padding: 20px;
        }
        .form-container, .show-result {
            max-width: 400px;
            margin: 20px auto;
            background-color: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
        }
        legend, h1 {
            margin-bottom: 20px;
            color: #ffcc00;
            text-shadow: 0 0 5px #000;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #ffcc00;
        }
        input[type="text"] {
            width: 100%;
            padding: 12px;
            border: none;
            background-color: rgba(255, 255, 255, 0.86);
            color: black;
            border-radius: 3px;
            box-sizing: border-box;
        }
        input[type="submit"], .borrar-btn {
            margin-top: 20px;
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
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
        }
        input[type="submit"]:hover, .borrar-btn:hover {
            background-color: #5c8bd6;
        }
        .clear-btn {
            background-color: #a74a4a;
        }
        .clear-btn:hover {
            background-color: #d65c5c;
        }
        .form-group {
            margin-bottom: 20px;
        }
        #new-text p {
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
            padding: 10px 15px;
            margin: 10px 0;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            font-size: 16px;
            font-weight: 500;
            line-height: 1.5;
            transition: all 0.3s ease-in-out;
        }
        #new-text p:hover {
            background-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.4);
        }
    </style>
</head>

<body>
    <section>
        <div class="form-container">
            <form action="" method="post">
                <fieldset>
                    <legend>Formulario</legend>
                    <div class="form-group">
                        <label for="input-text">Introduce Texto:</label>
                        <input type="text" id="input-text" name="input-text" required>
                        <input type="submit" value="Añadir">
                    </div>
                </fieldset>
            </form>
        </div>

        <div class="show-result">
            <h1>Resultados</h1>
            <div id="new-text">
            <?php
            // Mostrar los textos almacenados en el JSON
            if (!empty($texts)) {
                // Recorrer el array de textos y mostrar cada uno
                foreach ($texts as $text) {
                    echo "<p>$text</p>";
                }

                // Mostrar botón para borrar todos los textos
                echo '<form action="" method="post" onsubmit="return confirmDelete()">
                        <input type="submit" name="borrar-texts" value="Borrar Todo" class="borrar-btn">
                    </form>';
            } else {
                echo "<p>No hay textos almacenados.</p>";
            }
            ?>
            <script>
                // Función para confirmar el borrado de todos los textos
                function confirmDelete() {
                    return confirm("¿Estás seguro de que quieres borrar todos los textos?");
                }
            </script>
            </div>
        </div>
    </section>
</body>

</html>
