<?php
/* 
    Crear una función suma que reciba dos números como parámetros
    y muestra por pantalla su suma con un echo
    Hacer otra versión de la función, pero esta vez tiene que devolver el valor
 */
function suma($num1, $num2)
{
    $suma = $num1 + $num2;
    echo "La suma de $num1 y $num2 es: $suma";
}
echo "<p>con un echo</p>";
suma(7, 14);
echo "<hr>";
function sumav2($num1, $num2)
{
    return $num1 + $num2;
}
echo "<p>con un return</p>";
echo "La suma de 7 y 14 es: " . sumav2(7, 14);
