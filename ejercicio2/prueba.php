<?php

use Acme\TopSecret\SimpleCrypter;
use Acme\TopSecret\AES256Crypter;

require __DIR__ . '/libs/autoloader.php';

/*
$key = "kakalaka";
$crypter = new SimpleCrypter($key);

$text = "Del salón en el ángulo oscuro";

$encText = $crypter->encrypt($text);
$original = $crypter->decrypt($encText);

echo "Texto encriptado:" . PHP_EOL;
echo  $encText. PHP_EOL . PHP_EOL;

echo "Texto original:" . PHP_EOL;
echo  $original . PHP_EOL;
*/

$key = "kakalaka";
$crypter = new AES256Crypter($key);

$text = "Del salón en el ángulo oscuro";

$encText = $crypter->encrypt($text);
$original = $crypter->decrypt($encText);

echo "Texto encriptado:" . PHP_EOL;
echo  $encText. PHP_EOL . PHP_EOL;

echo "Texto original:" . PHP_EOL;
echo  $original . PHP_EOL;



