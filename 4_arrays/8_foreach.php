<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <main>
        <h1>Lista de la compra</h1>
        <section>
            <ul>
                <?php
                //Dado el siguiente array, hacer una lista de la compra
                $compra = ['lechuga', 'yogures', 'arroz'];
                //opcionalmente se puede empezar con un bucler for,
                //pero el objetivo es hacerlo con un foreach
                echo ("<strong>Con un foreach:<br></strong>");
                foreach ($compra as $producto) {
                    echo ("<li style='list-style:none;'>
                    <input type='checkbox' id='item-$producto'><label for='item-$producto'>$producto</li>");
                }
                ?>
            </ul>
        </section>
    </main>
</body>

</html>