<!-- Imprimir si un numero es par o impar -->
<?php
define("MIN", 1);
define("MAX", 100);
define("NUM", rand(MIN, MAX));
echo (NUM % 2 == 0 ? "El número " . NUM . " es par." : "El número " . NUM . " es impar.");
