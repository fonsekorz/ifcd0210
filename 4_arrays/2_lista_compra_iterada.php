<ul>
    <?php
    // Hacer un array con la lista de la compra y mostrarla con un bucle for y con un foreach
    $lista_compra = ["manzanas", "peras", "naranjas", "plátanos"];
    echo ("<strong>Con un for:<br></strong>");
    for ($i = 0; $i < count($lista_compra); $i++) {
        echo ("<li style='list-style:none;'><input type='checkbox'>$lista_compra[$i]</li>");
    }
    echo ("<strong>Con un foreach:<br></strong>");
    foreach ($lista_compra as $objeto) {
        echo ("<li style='list-style:none;'><input type='checkbox'>$objeto</li>");
    }
    ?>
</ul>