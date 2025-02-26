<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table border="1">
        <caption>Tabla de multiplicar del 7</caption>
        <?php
        define("NUM", 7);
        $resultado = 0;
        for ($i = 0; $i <= 10; $i++) {
            $resultado = NUM * $i;
            echo ("<tr><td>" . NUM . "x" . $i . "=" . $resultado . "</td></tr>");
        }
        ?>
    </table>
</body>

</html>