<?php
require __DIR__ . '/libs/autoloader.php';

use Acme\TopSecret as Crypters;

function _readline($prompt){
    if (PHP_OS == 'WINNT') {
        echo $prompt . ' ';
        $line = stream_get_line(STDIN, 1024, PHP_EOL);
      } else {
        $line = readline($prompt . ' ');
      }

      return $line;
}

if($argc != 3){
    $msg = <<< MSG
Uso: $argv[0]  operación "texto a cifrar"

El argumento "operación" puede ser: "encrypt" o "decrypt".
No olvide poner el texto entre comillas;
MSG;

    echo $msg. PHP_EOL;

    return;
}

$textMethod = "¿Qué método de cifrado quieres usar?" . PHP_EOL;
$textMethod .= "1. Simple " . PHP_EOL;
$textMethod .= "2. AES256 " . PHP_EOL;
$textMethod .= "Introduce el nº " . PHP_EOL;
echo $textMethod;exit;
$key = _readline('Introduce la clave: ');
$method = _readline($textMethod);
$oper = $argv[1];
$text = $argv[2];

$crypter = NULL;
switch($method){
    case '1':
        $crypter = new Crypters\SimpleCrypter($key);
        break;
    case '2':
        $crypter = new Crypters\AES256Crypter($key);
        break;
    default:
        echo "Método no soportado" . PHP_EOL;    
        return;
}

echo "El resultado es: " . PHP_EOL;

switch ($oper){
    case 'encrypt':
        echo $crypter->encrypt($text);
        break;
    case 'decrypt':
        echo $crypter->decrypt($text);
        break;
    default:
        echo "Operación no permitida";
}

echo PHP_EOL;