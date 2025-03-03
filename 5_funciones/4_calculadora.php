<?php
/* 
    Crear una función por cada operación básica: suma, resta, multiplicación y división
    Probar individualmente cada función para ver si funcionan correctamente (cuidado con dividir entre 0)

    Una vez hechas, hacer una función que reciba 3 parámetros (numero1, numero2 y operación a realizar):
    Si la función recibe la operación "+", ha de llamar a la función "suma" creada con anterioridad con los números recibidos.
    de igual manera ha ocurrir si recibe la operación "-", "*" y "/"
    Si la operación no es ninguna de las anteriores, se ha de mostrar un mensaje de error: "Operación desconocida"

*/
function suma($num1, $num2)
{
    return $num1 + $num2;
}
function resta($num1, $num2)
{
    return $num1 - $num2;
}
function multiplicacion($num1, $num2)
{
    return $num1 * $num2;
}
function division($num1, $num2)
{
    if ($num2 == 0) {
        return "Error: no se puede dividir por 0";
    }
    return $num1 / $num2;
}
echo "la suma de 3 y de 10 es: " . suma(3, 10) . "<br>";
echo "la resta de 3 y de 10 es: " . resta(3, 10) . "<br>";
echo "la multiplicación de 3 y de 10 es: " . multiplicacion(3, 10) . "<br>";
echo "la división de 3 y de 10 es: " . division(3, 10) . "<br>";
echo "<hr>";
function calculadora($num1, $num2, $operador)
{
    switch ($operador) {
        case '+':
            return suma($num1, $num2);
        case '-':
            return resta($num1, $num2);
        case '*':
            return multiplicacion($num1, $num2);
        case '/':
            return division($num1, $num2);
        default:
            echo "operación desconocida";
    }
}
echo "la suma de 3 y de 10 es: " . calculadora(3, 10, '+') . "<br>";
echo "la resta de 3 y de 10 es: " . calculadora(3, 10, '-') . "<br>";
echo "la multiplicación de 3 y de 10 es: " . calculadora(3, 10, '*') . "<br>";
echo "la división de 3 y de 10 es: " . calculadora(3, 10, '/') . "<br>";
