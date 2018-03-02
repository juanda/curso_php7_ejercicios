<?php

use Acme\TopSecret\AES256Encrypter;

require __DIR__ . '/libs/autoloader.php';

$e = new AES256Encrypter('kakalakaka');

echo $e->encrypt("Hola que tal");