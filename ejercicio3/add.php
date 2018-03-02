<?php

require __DIR__  . '/libs/autoloader.php';

use Acme\TopSecret\AES256Crypter;
use Acme\KeyStorage\KeyFileStorage;
use Acme\KeyStorage\KeyRegister;

$keyfile = "keyfile";

$name = readline('name: ');
$username = readline('username: ');
$password = readline('password: ');
$comment = readline('comment: ');
$key = readline('key: ');

$crypter = new AES256Crypter($key);

$register = KeyRegister::createFromArray($name, [
    'username' => $username,
    'password' => $password,
    'comment' => $comment
]);

$keyStorage = new KeyFileStorage($crypter, $keyfile);

if($keyStorage->add($register)){
    echo "Registro añadido correctamente" . PHP_EOL;
}else{
    echo "No he podido añadir el registro" . PHP_EOL;
}



