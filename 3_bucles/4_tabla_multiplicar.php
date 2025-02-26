<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            text-align: center;
        }

        table {
            border: solid;
            border-radius: 0.5em;
        }

        td {
            border: solid;
            border-radius: 0.2em;
            background-color: grey;
            width: 3em;
        }

        td:nth-child(even) {
            background-color: red;
        }
    </style>
</head>

<body>
    <table>
        <caption>Tabla de multiplicar del 7</caption>
        <tr>
            <th>Operador</th>
            <th>Resultado</th>
        </tr>
        <?php
        define("NUM", 7);
        $resultado = 0;
        for ($i = 0; $i <= 10; $i++) {
            $resultado = NUM * $i;
            echo ("<tr><td>" . NUM . "x" . $i . "</td><td>" . $resultado . "</td></tr>");
        }
        ?>
    </table>
</body>

</html>