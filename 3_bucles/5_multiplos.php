<?php
echo ("Mostrar los múltiplos de 3 que hay del 1 al 300<br>");
for ($i = 3; $i <= 300; $i+=3) {
    if ($i % 3 == 0) {
        echo ("$i<br>");
    }
}
