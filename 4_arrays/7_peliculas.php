<?php

/*
Crear un objeto(array asociativo) que represente una película.
Para ello ha de tener lo siguientes campos:
- titulo
- año
- director
- genero


Una vez creado un objeto, intentar crear un array con 3 películas,
iterarlas para mostrarlas en 3 divs html con sus correspondientes atributos
*/
$peliculas = [
    [
        "titulo" => 'El gran Lebowsky',
        "año" => 1998,
        "director" => 'Los hermanos Coen',
        "genero" => 'Comedia'
    ],
    [
        "titulo" => 'Enemigo a las puertas',
        "año" => 2001,
        "director" => 'Jean-Jacques Annaud',
        "genero" => 'Belico'
    ],
    [
        "titulo" => 'Como entrenar a tu dragon',
        "año" => 2010,
        "director" => 'Chris Sanders, Dean DeBlois',
        "genero" => 'Animacion'
    ]
];

// var_dump($peliculas);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            box-sizing: border-box;
        }

        main {
            max-width: 900px;
            margin: auto;
        }

        #peliculas {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .card {
            padding: 1rem;
            box-shadow: 0 0 0.5rem rgba(0, 0, 0, 0.3);
            flex: 1;
            min-width: 270px;
        }

        span {
            margin: 5px;
        }
    </style>
</head>

<body>
    <main>
        <h1>Peliculas</h1>
        <section id="peliculas">
            <?php foreach ($peliculas as $peli) { ?>
                <div class="card">
                    <h2><?= $peli['titulo'] ?><span><?= $peli['año'] ?></span></h2>
                    <p>Dirigido por: <?= $peli['director'] ?></p>
                    <p>Género: <?= $peli['genero'] ?></p>
                </div>
            <?php } ?>
        </section>
    </main>
</body>

</html>