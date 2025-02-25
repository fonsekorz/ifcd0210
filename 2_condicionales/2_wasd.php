<?php
/* 
Crear un programa que emule los controles de un videojuego: si pulso 
si pulso w:'adelante'
si pulso a:'izqueirda'
si pulso s:'abajo'
si pulso d:'derecha'
*/
$tecla = "d";
echo ("La tecla es:$tecla<br>");
switch ($tecla) {
    case "w":
        echo ("Adelante");
        break;
    case "a":
        echo ("Izquierda");
        break;
    case "d":
        echo ("Derecha");
        break;
    case "s":
        echo ("Abajo");
        break;
    default:
        echo ("Tecla incorrecta");
        break;
}
//modificar