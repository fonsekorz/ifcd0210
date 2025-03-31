<?php


function mostrarLista()
{
    //1) Leer contenido de compra.json ->file_get_contents('ruta_al_fichero') 
    //tip: igualar una variable a la función para guardar el texto en dicha variable
    //2) Convertir el contenido(string) a un array que pueda iterar -> json_decode($texto_del_json, true)
    //3) Iterar el array renderizando (pintando) el html pertinente 
    $jsonFile = 'compra.json';
    $array = json_decode(file_get_contents($jsonFile), true);
    var_dump($jsonFile);
    echo "<hr>";
    foreach ($array as $elemento) {
        foreach ($elemento as $value) {
            echo "$value ";
        }
        echo "<br>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1><?php mostrarLista() ?></h1>
</body>

</html>