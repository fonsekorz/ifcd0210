<!-- Imprimir si un numero es par o impar -->
<?php
define("NUM", rand(1, 100));
echo (NUM % 2 == 0 ? "El número " . NUM . " es par." : "El número " . NUM . " es impar.");
