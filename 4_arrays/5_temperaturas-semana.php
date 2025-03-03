<?php
/* 
    Crear un array $dias con las siguientes claves: "lunes","martes", ..., "sábado", "domingo"

    Iterando ese array, crear otro array asociativo $temperaturas:
        - cuya clave es el día de la semana
        - el valor es un número aleatorio 

    Iterar $temperaturas, mostrando el texto "la temperatura del lunes es X ºC, ..."

    Pista: el método push() puede resultar útil para añadir elementos a un array nuevo
*/
$dias = [
    "lunes",
    "martes",
    "miercoles",
    "jueves",
    "viernes",
    "sabado",
    "domingo"
];

$temperaturas = [];

foreach ($dias as $valor) {
    $temperaturas[$valor] = rand(-10, 50);
}

// var_dump($temperaturas);

foreach ($temperaturas as $dia => $temp) {
    echo "La temperatura del $dia es $temp ºC<br>";
}
