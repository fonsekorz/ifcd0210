<?php

function mostrarLista()
{
    //... aquí va el código que lee el fichero json, lo convierte a array y lo "pinta" 
    $jsonFile = 'compra.json';
    $array = json_decode(file_get_contents($jsonFile), true);
    echo '<table border="1">';
    echo "<th>Producto</th><th>Precio</th>";
    foreach ($array as $elemento) {
        echo "<tr>";
        foreach ($elemento as $valor) {
            echo "<td>$valor</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Compra</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
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
            width: 50%;
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

        /* Tabla */
        table {
            width: 60%;
            margin: 20px auto;
            border-collapse: collapse;
            background: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
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
    <h1>Mi lista de la compra</h1>

    <form action="añadir.php" method="post">
        <fieldset>
            <label for="input-producto">Añadir Producto</label>
            <input type="text" name="input-producto" id="producto">
            <label for="input-precio">Añadir Precio</label>
            <input type="number" name="input-precio" id="precio" step="0.01"><br>
            <input type="submit" value="Añadir" name="submit-nuevo">
            <input type="submit" value="Borrar" name="submit-borrar">
        </fieldset>
    </form>

    <?php mostrarLista() ?>

</body>

</html>