<?php

require __DIR__  . '/libs/autoloader.php';
require __DIR__ . '/readline.php';

use Acme\TopSecret\AES256Crypter;
use Acme\KeyStorage\KeyFileStorage;
use Acme\KeyStorage\KeyRegister;

$keyfile = "keyfile";

$key = _readline('key: ');

$crypter = new AES256Crypter($key);

$keyStorage = new KeyFileStorage($crypter, $keyfile);

print_r($keyStorage->getAll());


