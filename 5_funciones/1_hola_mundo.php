<?php
/* 
    Crear una función que haga echo de "hola mundo!". Probar a llamarla múltiples veces
*/
function saludo()
{
    echo "hola mundo! ";
}
for ($i=0; $i < 5; $i++) { 
    saludo();
}
