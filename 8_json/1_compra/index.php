<?php


function mostrarLista()
{
    //1) Leer contenido de compra.json ->file_get_contents('ruta_al_fichero') 
    //tip: igualar una variable a la función para guardar el texto en dicha variable
    //2) Convertir el contenido(string) a un array que pueda iterar -> json_decode($texto_del_json, true)
    //3) Iterar el array renderizando (pintando) el html pertinente 
    $jsonFile = 'compra.json';
    $array = json_decode(file_get_contents($jsonFile), true);
    echo "<ul>";
    foreach ($array as $elemento) {
        foreach ($elemento as $key => $value) {
            echo "<li style='list-style-type:none;'>$key : $value</li>";
        }
    }
    echo "</ul>";
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
    <h1>Lista de la compra</h1>
    <p><?php mostrarLista() ?></p>
</body>

</html>