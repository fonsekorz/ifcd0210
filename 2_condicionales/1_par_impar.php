<!-- Imprimir si un numero es par o impar -->
<?php
define("MIN", rand(1, 100));
define("MAX", rand(1, 100));
define("NUM", rand(MIN, MAX));
echo (NUM % 2 == 0 ? "El número " . NUM . " es par." : "El número " . NUM . " es impar.");
