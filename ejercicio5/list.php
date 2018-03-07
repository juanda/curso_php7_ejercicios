<?php

require __DIR__ . '/libs/autoloader.php';
require __DIR__ . '/readline.php';

use Acme\KeyStorage\KeyFileStorage;
use Acme\TopSecret\AES256Crypter;

$keyfile = "keyfile";

$items = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $key = $_POST['key'];

    $crypter = new AES256Crypter($key);

    $keyStorage = new KeyFileStorage($crypter, $keyfile);

    $items = $keyStorage->getAll();

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
        <table>
        <th>
            <td>name</td>
            <td>username</td>
            <td>password</td>
            <td>comment</td>
        </th>
        <?php foreach($items as $item): ?>
        <tr>
            <td><?php echo $item['name']?></td>
            <td><?php echo $item['username']?></td>
            <td><?php echo $item['password']?></td>
            <td><?php echo $item['comment']?></td>            
        </tr>
        <?php endforeach ?>
        </table>
        <form action="list.php" method="post">            
            key: <input name="key" id="key" />
            <input type="submit" value="dale"/>
        </form>
    </body>
</html>

