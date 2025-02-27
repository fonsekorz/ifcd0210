<?php
/* Crear una lista de la compra, que contenga al menos 4 elementos
Utilizar un var_dump() para ver su contenido, modificar el 3er elemento y volvais a mostrarlo con el var_dump() */
$lista_compra = ["manzanas", "peras", "naranjas", "plátanos"];
var_dump($lista_compra);
echo("<br>");
$lista_compra[2] = "modificado";
var_dump($lista_compra);
