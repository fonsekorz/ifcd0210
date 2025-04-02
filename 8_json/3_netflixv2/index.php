<?php

$jsonFile = 'pelis.json';
$peliculas = json_decode(file_get_contents($jsonFile), true);
function mostrarPelis($array)
{
    foreach ($array as $pelicula) {
        echo "<div class='card'>";
        echo "<span>" . htmlspecialchars($pelicula['titulo'], ENT_QUOTES, 'UTF-8') . "</span>";
        echo "<span>Año: " . htmlspecialchars($pelicula['año'], ENT_QUOTES, 'UTF-8') . "</span>";
        echo "<span>Director: " . htmlspecialchars($pelicula['director'], ENT_QUOTES, 'UTF-8') . "</span>";
        echo "Genero: <span> " . htmlspecialchars(implode(", ", $pelicula['generos']), ENT_QUOTES, 'UTF-8') . "</span>";
        echo "</div>";
    }
}

function filtrarPeli($elemento)
{
    global $peliculas;

    // Comprobar si el género es válido (no vacío)
    if (empty($elemento)) {
        echo "<p class='mensaje-error'>Por favor, ingresa un género válido.</p>";
        return;
    }

    // Filtrar las películas basándose en el género
    $pelisfiltradas = array_filter($peliculas, function ($pelicula) use ($elemento) {
        // Asegurarse de que la película tiene un array de géneros
        if (isset($pelicula['generos']) && is_array($pelicula['generos'])) {
            // Verificar si el género buscado existe en los géneros de la película
            return in_array($elemento, array_map('trim', $pelicula['generos']));
        }
        return false;
    });

    // Mostrar las películas filtradas
    if (!empty($pelisfiltradas)) {
        mostrarPelis($pelisfiltradas);
    } else {
        echo "<p class='mensaje-error'>No se encontraron películas con el género '$elemento'.</p>";
    }
}

function agregarPelicula($elemento)
{
    global $peliculas;

    // Comprobamos si el elemento es un array y si tiene las claves necesarias
    if (is_array($elemento) && isset($elemento['titulo'], $elemento['año'], $elemento['director'])) {
        // Validar que los campos no estén vacíos
        if (empty($elemento['titulo']) || empty($elemento['año']) || empty($elemento['director'])) {
            return; // No agregamos la película si alguno de los campos está vacío
        }

        // Agregar la nueva película al array de películas
        $peliculas[] = $elemento;

        // Guardar las películas en el archivo JSON
        file_put_contents('pelis.json', json_encode($peliculas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}

function ResetearPelis()
{
    //Restaurar el archivo original
    copy('pelis_originales.json', 'pelis.json');
}

function eliminarPelicula($titulo)
{
    global $peliculas;

    // Filtrar las películas eliminando la que tenga el título dado
    $peliculas = array_filter($peliculas, function ($pelicula) use ($titulo) {
        // Comparación de título sin importar mayúsculas/minúsculas
        return strtolower(trim($pelicula['titulo'])) !== strtolower(trim($titulo));
    });

    // Reindexar el array después de eliminar
    $peliculas = array_values($peliculas);

    // Guardar el nuevo JSON sin la película eliminada
    file_put_contents('pelis.json', json_encode($peliculas, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}

// Eliminar una película del array y guardar en el archivo JSON
// Si se presiona el botón de eliminar, se elimina la película
// y se redirige a la página principal
if (isset($_POST['submit-eliminar']) && isset($_POST['eliminar-peli']) && !empty($_POST['eliminar-peli'])) {
    $tituloAEliminar = $_POST['eliminar-peli'];
    eliminarPelicula($tituloAEliminar);
    header("Location: index.php");
    exit;
}

//Resetear las películas originales
//Si se presiona el botón de resetear, se restauran las películas originales
// y se redirige a la página principal
if (isset($_POST['reset'])) {
    ResetearPelis();
    header("Location: index.php");
    exit;
}

// Agregar una película al array y guardar en el archivo JSON
// Comprobar si el formulario ha sido enviado
if (isset($_POST['submit-agregar']) && isset($_POST['agregar-peli']) && !empty($_POST['agregar-peli'])) {
    // Limpiar y validar los datos del formulario
    $titulo = trim($_POST['agregar-peli']);
    $año = trim($_POST['agregar-año']);
    $director = trim($_POST['agregar-director']);
    $generos = array_map('trim', explode(',', $_POST['agregar-generos']));

    // Crear un array para la nueva película
    $nuevaPelicula = [
        'titulo' => htmlspecialchars($titulo),  // Sanitizar el título 
        'año' => $año,  // No es necesario sanitizar el año, pero se puede validar si es un número
        'director' => htmlspecialchars($director),  // Sanitizar el director
        'generos' => array_map('htmlspecialchars', $generos)  // Sanitizar los géneros
    ];

    // Agregar la película al array y guardar en el archivo JSON
    agregarPelicula($nuevaPelicula);

    // Redirigir para evitar reenvío de formulario y mostrar la nueva lista de películas
    header("Location: index.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Películas</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: rgba(0, 0, 0, 0.81);
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        h1 {
            color: #0056b3;
            width: 100%;
            text-align: center;
            border: 2px solid #0056b3;
            padding: 20px;
            border-radius: 10px;
            background-color: #f1f5f9;
            margin-bottom: 10px;
        }

        h1.h1form {
            background-color: rgba(138, 136, 136, 0.57);
        }

        #main-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 20px;
            border: 2px solid #0056b3;
            padding: 20px;
            border-radius: 10px;
            background-color: #f1f5f9;
            min-width: 100%;
        }


        #form-container {
            flex: 1;
            max-width: 40%;
            position: static;
            top: 20px;
            margin-left: 20px;
            margin-bottom: 20px;
            box-sizing: border-box;
            background-color: #f1f5f9;
            border-radius: 10px;
            padding: 0 20px 20px 20px; 
            flex-wrap: wrap;
        }

        #movies-container {
            flex: 1;
            max-width: 60%;
            background-color: #f1f5f9;
            border-radius: 10px;
            padding: 20px;
            display: flex;
            justify-content: space-around;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .cajas {
            justify-content: center;
            align-items: center;
            background-color: rgba(138, 136, 136, 0.57);
            border: 2px solid #0056b3;
            padding: 20px;
            margin: 20px auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            border-collapse: collapse;
            overflow: hidden;
        }

        .card {
            width: 20%;
            padding: 1rem;
            box-shadow: 0 0 0.5rem rgba(0, 0, 0, 0.3);
            flex: 1;
            min-width: 270px;
            max-width: 50%;
            background-color: rgba(138, 136, 136, 0.57);
            transition: background-color 0.3s ease, transform 0.2s ease;
            border: 2px solid #0056b3;
            border-radius: 10px;
            border-collapse: collapse;
            overflow: hidden;
            text-overflow: ellipsis;
            word-wrap: break-word;
        }

        .card:hover {
            background-color: #e0e0e0;
            transform: scale(1.02);
        }

        .card span {
            display: block;
            padding: 8px 5px;
            margin-bottom: 10px;
            line-height: 1.4;
            font-size: 1rem;
            position: relative;
        }

        .card span:nth-child(1) {
            font-size: 1.3rem;
            font-weight: bold;
            color: #0056b3;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 10px;
            margin-bottom: 15px;
            text-align: center;
        }

        .card span:nth-child(2) {
            background-color: #f8f9fa;
            border-radius: 20px;
            padding: 5px 12px;
            font-weight: 600;
            color: #444;
            display: inline-block;
            margin-right: 5px;
            text-align: center;
        }

        .card span:nth-child(3) {
            font-style: italic;
            color: #555;
            border-left: 3px solid #0056b3;
            padding-left: 10px;
            margin: 8px 0;
            font-weight: bold;
        }

        .card span:nth-child(4) {
            background-color: #e6f2ff;
            color: #0056b3;
            border-radius: 5px;
            padding: 8px 12px;
            font-size: 0.9rem;
            margin-top: 5px;
        }

        .mensaje-error {
            color: #d9534f;
            background-color: #f2dede;
            border: 1px solid #ebccd1;
            padding: 10px;
            border-radius: 5px;
            font-size: 1.1em;
            text-align: center;
            margin-top: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        fieldset {
            border: none;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            text-align: center;
        }

        input[type="text"],
        [type="number"] {
            width: 100%;
            padding: 10px;
            border: 2px solid #0056b3;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #0056b3;
            color: white;
            border: none;
            padding: 12px 20px;
            margin-top: 10px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #003d80;
            transform: scale(1.02);
        }

        /* Estilos para dispositivos móviles y tabletas en modo vertical (máximo 768px) */
        @media screen and (max-width: 768px) {
            #main-container {
                flex-direction: column;
                align-items: center;
            }

            #form-container,
            #movies-container {
                width: 100%;
                max-width: 100%;
                margin: 0;
            }

            #form-container {
                margin-bottom: 20px;
            }
        }

        /* Estilos para pantallas de tabletas horizontales, portátiles y monitores */
        @media screen and (min-width: 769px) and (max-width: 1200px) {
            #main-container {
                flex-direction: row;
                align-items: flex-start;
            }

            #form-container,
            #movies-container {
                width: 48%;
                margin: 10px;
            }
        }

        /* Estilos para pantallas grandes (mayores a 1200px) */
        @media screen and (min-width: 1201px) {
            #main-container {
                flex-direction: row;
                justify-content: space-between;
            }

            #form-container,
            #movies-container {
                width: 48%;
            }
        }
    </style>
</head>

<body>
    <h1>Películas</h1>
    <div id="main-container">
        <div id="movies-container">
            <?php
            if (isset($_POST['submit-peli']) && isset($_POST['buscar-peli']) && !empty($_POST['buscar-peli'])) {
                filtrarPeli($_POST['buscar-peli']);
            } else {
                mostrarPelis($peliculas);
            }
            ?>
        </div>
        <div id="form-container">
            <h1 class="h1form">Formulario</h1>
            <form action="index.php" method="post" class="cajas">
                <fieldset>
                    <label for="buscar-peli">Buscar película por genero:</label>
                    <input type="text" id="buscar-peli" name="buscar-peli" placeholder="Género">
                    <input type="submit" name="submit-peli" value="Buscar">
                    <label for="agregar-peli">Agregar película</label>
                    <input type="text" id="agregar-peli" name="agregar-peli" placeholder="Título">
                    <label for="agregar-año">Agregar año</label>
                    <input type="number" id="agregar-año" name="agregar-año" placeholder="Año">
                    <label for="agregar-director">Agregar director</label>
                    <input type="text" id="agregar-director" name="agregar-director" placeholder="Director">
                    <label for="agregar-generos">Agregar géneros</label>
                    <input type="text" id="agregar-generos" name="agregar-generos"
                        placeholder="Géneros (separados por comas)">
                    <input type="submit" name="submit-agregar" value="Agregar">
                    <label for="eliminar-peli">Eliminar película</label>
                    <input type="text" id="eliminar-peli" name="eliminar-peli" placeholder="Título de la película">
                    <input type="submit" name="submit-eliminar" value="Eliminar">
                    <label for="reset">Ver todas las películas</label>
                    <input type="submit" name="reset" value="Ver">
                </fieldset>
            </form>
        </div>
    </div>
</body>

</html>