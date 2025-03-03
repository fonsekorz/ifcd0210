<?php
/* 
Crear una función llamada saludar que recibe la hora en formato 0-24:
    si la hora recibida es de de 6 a 12 : saludar con "buenos días!"
    si la hora recibida es de de 12 a 20 : saludar con "buenas tardes!"
    si la hora es de 20 a 6 (o si no entra en ninguno de los dos intervalos anteriores): "buenas noches!"
*/
function saludar($hora)
{
    if (!is_numeric($hora) || $hora < 0 || $hora > 23) {
        echo "error: formato no válido.";
        return;
    }
    if ($hora >= 6 && $hora < 12) {
        echo "buenos días!";
    } elseif ($hora >= 12 && $hora < 20) {
        echo "buenas tardes!";
    } else {
        echo "buenas noches!";
    }
}
echo "<p>son las 11</p>";
saludar(11);
echo "<hr>";
echo "<p>Meto un 'hola'</p>";
saludar("hola");
echo "<hr>";
echo "<p>son las 20</p>";
saludar(20);
echo "<hr>";
echo "<p>Meto un -4</p>";
saludar(-4);
echo "<hr>";
