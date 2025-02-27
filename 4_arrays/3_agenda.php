<?php
/* 
Realizar una agenda de 3 personas:
Guardar en un array asociativo el nombre de la persona como clave y su número como valor
Pista
["clave" => "valor", ...]
*/
$agenda = [
    "LELE" => 98412345,
    "LALA" => 98454321,
    "LOLO" => 98412354,
];

foreach ($agenda as $nombre => $telefono) {
    echo ("$nombre: $telefono<br>");
}
