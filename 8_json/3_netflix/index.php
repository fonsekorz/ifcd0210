<?php


$jsonFile = 'pelis.json';
$peliculas = json_decode(file_get_contents($jsonFile), true);

function mostrarPelis($array)
{
    echo "<table class='cajas'>";
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

    foreach ($peliculas as $pelicula) {
        foreach ($pelicula['generos'] as $genero) {
            if ($genero == $elemento) {
                $pelisfiltradas[] = $pelicula;
                break;
            }
        }
    }
    if (!empty($pelisfiltradas)) {
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
        *{
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #0056b3;
        }

        #form-container {
            width: 90%;
            margin: 0 auto;
            max-width: 600px;
        }

        .cajas {
            justify-content: center;
            align-items: center;
            background: #ffffff;
            padding: 20px;
            margin: 20px auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            border-collapse: collapse;
            overflow: hidden;
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
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
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
            background-color: #004085;
        }

        td,
        th {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #0056b3;
            color: white;
        }

        tr:hover {
            background-color: #e9ecef;
        }

        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .cajas {
                padding: 15px;
            }

            input[type="text"],
            [type="number"] {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div id=form-container>
        <h1>Películas</h1>
        <?php
        if (isset($_POST['submit-peli']) && isset($_POST['buscar-peli']) && !empty($_POST['buscar-peli'])) {
            $resultado = filtrarPeli($_POST['buscar-peli']);
        } else {
            mostrarPelis($peliculas);
        }
        ?>
        <form action="index.php" method="post" class="cajas">
            <fieldset>
                <label for="buscar-peli">Buscar pelicula por genero:</label>
                <input type="text" id="buscar-peli" name="buscar-peli">
                <input type="submit" name="submit-peli" value="Buscar">
            </fieldset>
    </div>
</body>

</html>