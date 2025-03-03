<?php
/* 
Función "filtrar" que recibe un array de películas
y devuelve otro array con aquellas películas que pertenecen a un género especificado por parámetro


Función "mostrar" que recibe un array de películas 
y las muestra en sus correspondientes divs html como en  el ejercicio 7 del apartado 4_arrays

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
function filtrar($array, $genero)
{
    $resultado = [];
    foreach ($array as $peli) {
        if ($peli['genero'] === $genero) {
            $resultado[] = $peli;
        }
    }
    return $resultado;
}

function mostrar($array)
{
    foreach ($array as $peli) {
        echo '<div class="card">';
        echo '<h2>' . $peli['titulo'] . ' <span>(' . $peli['año'] . ')</span></h2>';
        echo '<p>Dirigido por: ' . $peli['director'] . '</p>';
        echo '<p>Género: ' . $peli['genero'] . '</p>';
        echo '</div>';
    }
}
// Mostrar peliculas
$genero_filtrado = 'Belico';
$peliculas_filtradas = filtrar($peliculas, $genero_filtrado);
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
        <h1>Películas de género: <?= $genero_filtrado ?></h1>
        <section id="peliculas">
            <?php mostrar($peliculas_filtradas); ?>
        </section>
    </main>
</body>

</html>