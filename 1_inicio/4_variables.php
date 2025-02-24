<?php
$var_string = "hola";
$var_num_uno = 20;
$var_num_dos = 30;
$var_booleano = true;

echo "concatenar la variable string con otro texto<br>\n";
echo $var_string . " mundo<br>\n";
echo "sumar ambos números<br>\n";
echo $var_num_uno + $var_num_dos . "<br>\n";
echo "dividir los números<br>\n";
echo $var_num_uno / $var_num_dos . "<br>\n";
echo "hallar el módulo de los números (el resto de dividir uno entre otro)<br>\n";
echo $var_num_uno % $var_num_dos . "<br>\n";
echo "ver si uno de los números es mayor o igual que el otro<br>\n";
if ($var_num_uno > $var_num_dos) {
    echo $var_num_uno . "<br>\n";
} else {
    echo $var_num_dos . "<br>\n";
}
echo "mostrar la variable booleana<br>\n";
echo ($var_booleano ? "true" : "false") . "<br>\n";
echo "negar la variable booleana<br>\n";
$var_booleano = !$var_booleano;
echo ($var_booleano ? "true" : "false") . "<br>\n";
