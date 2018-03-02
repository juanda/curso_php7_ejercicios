<?php

require(__DIR__ . '/lib.php');

if($argc != 3){
    $msg = <<< MSG
Uso: $argv[0]  operación "texto a cifrar"

El argumento "operación" puede ser: "encrypt" o "decrypt".
No olvide poner el texto entre comillas;
MSG;

    echo $msg. PHP_EOL;

    return;
}

$key = readline('Introduce la clave: ');
$oper = $argv[1];
$text = $argv[2];
echo $text;
echo "El resultado es: " . PHP_EOL;

switch ($oper){
    case 'encrypt':
        echo encrypt($text, $key);
        break;
    case 'decrypt':
        echo decrypt($text, $key);
        break;
    default:
        echo "Operación no permitida";
}

echo PHP_EOL;