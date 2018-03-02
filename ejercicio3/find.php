<?php

require __DIR__  . '/libs/autoloader.php';

use Acme\TopSecret\AES256Crypter;
use Acme\KeyStorage\KeyFileStorage;
use Acme\KeyStorage\KeyRegister;

if($argc != 2){
    echo "Uso: $argv[0] nombre_registro". PHP_EOL;
    exit;
}

$nombreRegistro = $argv[1];

$keyfile = "keyfile";

$key = readline('key: ');

$crypter = new AES256Crypter($key);

$keyStorage = new KeyFileStorage($crypter, $keyfile);

$item = $keyStorage->find($nombreRegistro);

if(is_null($item)){
    
}
print_r();
