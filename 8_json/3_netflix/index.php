<?php


$jsonFile = 'pelis.json';
$peliculas = json_decode(file_get_contents($jsonFile), true);

function mostrarPelis($array)
{
    echo "<table>";
    echo "<tr>";
    echo "<th>Título</th>";
    echo "<th>Año</th>";
    echo "<th>Director</th>";
    echo "<th>Géneros</th>";
    echo "</tr>";
    foreach ($array as $pelicula) {
        echo "<tr>";
        echo "<td>$pelicula[titulo]</td>";
        echo "<td>$pelicula[año]</td>";
        echo "<td>$pelicula[director]</td>";
        echo "<td>";
        echo implode(", ", $pelicula['generos']);
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

function filtrarPeli($elemento)
{
    global $peliculas;
    $pelisfiltradas = [];

    echo "<h1>Películas Filtradas</h1>";
    foreach ($peliculas as $pelicula) {
        foreach ($pelicula['generos'] as $genero) {
            if ($genero == $elemento) {
                $pelisfiltradas[] = $pelicula;
                break;
            }
        }
    }
    if (empty($pelisfiltradas)) {
        echo "<h1>No existe ninguna película con el género '$elemento'.</h1>";
    } else {
        mostrarPelis($pelisfiltradas);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Películas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgba(99, 101, 102, 0.4);
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #007bff;
        }

        form {
            background: #ffffff;
            padding: 20px;
            margin: 20px auto;
            width: 47%;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        fieldset {
            border: none;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input[type="text"],
        [type="number"] {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            width: 84%;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-top: 10px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: rgb(135, 159, 184);
        }

        table {
            background: #ffffff;
            padding: 20px;
            margin: 20px auto;
            width: 50%;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-collapse: collapse;
            overflow: hidden;
        }

        td,
        th {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    <h1>Películas</h1>
    <?php mostrarPelis($peliculas) ?>
    <form action="index.php" method="post">
        <fieldset>
            <label for="buscar-peli">Buscar pelicula por genero:</label>
            <input type="text" id="buscar-peli" name="buscar-peli">
            <input type="submit" name="submit-peli" value="Buscar">
        </fieldset>
    </form>
    <?php
    if (isset($_POST['submit-peli'])  && !empty($_POST['buscar-peli'])) {
        $resultado = filtrarPeli($_POST['buscar-peli']);
    }
    ?>
</body>

</html>