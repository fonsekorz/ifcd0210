<?php

/**
 * 
 * Dado el siguiente array de alumnos, realizar las siguientes funciones:
 * 
 * - Mostrar nombres: función que recibe el array y "pinta" un html con todos los nombres, notas y curso de los alumnos
 * - Filtrar alumnos: funcion que recibe el array y un curso, y devuelve otro array con todos los alumnos que cumplen el criterio
 * - Mostrar nota media: función que recibe un array de alumnos y devuelve la nota media
 */

$alumnos = [
    ["nombre" => "Juan Pérez", "nota" => 8.5, "curso" => "1º"],
    ["nombre" => "María López", "nota" => 9.2, "curso" => "2º"],
    ["nombre" => "Carlos Sánchez", "nota" => 7.8, "curso" => "1º"],
    ["nombre" => "Ana Torres", "nota" => 8.9, "curso" => "2º"],
    ["nombre" => "Luis Fernández", "nota" => 6.5, "curso" => "1º"],
    ["nombre" => "Sofía Ramírez", "nota" => 9.0, "curso" => "2º"],
    ["nombre" => "Pedro Gómez", "nota" => 7.3, "curso" => "1º"],
    ["nombre" => "Elena Duarte", "nota" => 8.7, "curso" => "2º"]
];

function mostrarNombres($array)
{
    foreach ($array as $index => $alumno) {
        echo "Alumno #" . ($index + 1) . ":<br>";
        foreach ($alumno as $clave => $valor) {
            echo "$clave : $valor <br>";
        }
        echo "<br>";
    }
}
function filtrarAlumnos($array, $curso)
{
    /* $arrayFiltrado = [];
    foreach ($array as $key => $valor) {
        if ($valor['curso'] == $curso) {
            $arrayFiltrado[] = $valor['nombre'];
        }
    }
    echo "Alumno del curso $curso : <br>";
    foreach ($resultado as $alumno) {
        echo $alumno . "<br>";
    }*/
    //arrayFiltrado = array_filter($alumnos,fn($al)=>$al['curso']==="1º")
    $arrayFiltrado = array_filter($array, fn($alumno) => $alumno['curso'] === $curso);
    echo "Alumnos del curso $curso : <br>";
    foreach ($arrayFiltrado as $alumno) {
        echo "$alumno[nombre] <br>";
    }
}
function notaMedia($array)
{
    $suma = 0;
    $cantidad = count($array);
    foreach ($array as $key => $valor) {
        $suma += $valor['nota'];
    }
    return  $suma / $cantidad;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Alumnos</h1>
    <p><?php mostrarNombres($alumnos) ?></p>
    <p>
        <?php
        $curso = "2º";
        filtrarAlumnos($alumnos, $curso)
        ?>
    </p>
    <p>Nota media: <?php echo notaMedia($alumnos) ?></p>

</body>

</html>