<?php

require __DIR__ . '/libs/autoloader.php';
require __DIR__ . '/readline.php';

use Acme\KeyStorage\KeyFileStorage;
use Acme\KeyStorage\KeyRegister;
use Acme\TopSecret\AES256Crypter;

$keyfile = "keyfile";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $comment = $_POST['comment'];
    $key = $_POST['key'];

    $crypter = new AES256Crypter($key);

    $register = KeyRegister::createFromArray($name, [
        'username' => $username,
        'password' => $password,
        'comment' => $comment,
    ]);

    $keyStorage = new KeyFileStorage($crypter, $keyfile);

    if ($keyStorage->add($register)) {
        $message = "Registro añadido correctamente";
    } else {
        $message = "No he podido añadir el registro";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Gestor de claves</title>                
    </head>
    <body>
        <h1>Gestor de claves</h1>
        <h3><?php echo $message?></h3>
        <form action="add.php" method="post">
            name: <input name="name" id="name" />
            username: <input name="username" id="username" />
            password: <input name="password" id="password" />
            comment: <input name="comment" id="comment" />
            key: <input name="key" id="key" />

            <input type="submit" value="dale"/>

        </form>
    </body>
</html>
