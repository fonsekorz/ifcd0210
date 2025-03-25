<?php
//Dado el siguiente array, hacer una lista de la compra
$compra = [
    [
        "nombre" => "arroz",
        "precio" => 2.99
    ],
    [
        "nombre" => "lechuga",
        "precio" => 1.05
    ],
    [
        "nombre" => "yogures",
        "precio" => 3.15
    ],
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <main>
        <h1>Lista compra</h1>
        <ul>
            <?php
            foreach ($compra as $producto) {
                echo "<li>$producto[nombre] - $producto[precio]</li>";
            }
            ?>
        </ul>
    </main>
</body>

</html>