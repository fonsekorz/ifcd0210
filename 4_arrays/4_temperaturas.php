<?php

/* 
Dado un array con la temperatura media de  cada día de la semana, sacar:
 - la temperatura máxima, 
 - la mínima 
 - y la temperatura media

*/


$temperaturas = [12, 15, 13, 12, 16, 11, 13];
$max = $temperaturas[0];
$min = $temperaturas[0];
$media = 0;
// Imprimir los valores del array
echo "Temperaturas: ";
foreach ($temperaturas as $valor) {
    echo  $valor . " ";
}
echo "<hr>";
// Recorrer el array
foreach ($temperaturas as $valor) {
    // Hallar la temperatura media
    $media += $valor / count($temperaturas);
    // si lo que vale $valor es mayor que lo que vale $max
    if ($valor > $max) {
        // $max recoge ese valor de $valor
        $max = $valor;
    }
    if ($valor < $min) {
        $min = $valor;
    }
}
echo "Temperatura máxima: " . $max . "<br>";
echo "Temperatura mínima: " . $min . "<br>";
echo "Temperatura media: " . round($media, 2) . "<br>";