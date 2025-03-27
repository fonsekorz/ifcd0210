<?php
/* 

Crear un programa en php que reciba dos parametros por la URL num1 y num2
en caso de que no se especifiquen, el programa mostrará el texto: "por favor, indique los parámetros correspondientes"
y en caso de que se especifiquen mostrar la suma de ambos números utilizando una función que devuelva: "la suma es: X"


Pista: la función isset($variable), nos permite comprobar si una variable está definida
*/
function suma($num1, $num2)
{
    return "La suma es: " . ($num1 + $num2);
}


if (isset($_GET['num1']) && isset($_GET['num2'])) {
    $num1 = $_GET['num1'];
    $num2 = $_GET['num2'];
    echo "<p>primer número es: " . $num1 . "</p>";
    echo "<p>segundo número es: " . $num2 . "</p>";
    if ($num1 != "" || $num2 != "") {
        // Comprobar que sean números
    }elseif (is_numeric($num1) && is_numeric($num2)) {
        echo "<h1>" . suma($num1, $num2) . "</h1>";
    } else {
        echo "<script>alert('Ingrese números válidos')</script>";
    }
} else {
    echo "<script>alert('Ingrese números')</script>";
}
