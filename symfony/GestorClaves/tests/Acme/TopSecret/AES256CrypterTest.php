<?php
namespace Test\Acme\TopSecret;

use Acme\TopSecret\AES256Crypter;
use PHPUnit\Framework\TestCase;

class AES256CrypterTest extends TestCase {

    public function testAdd() {
        $crypter = new AES256Crypter();
        $crypter->setKey('kaka');
        $result = $crypter->encrypt("Hola que tal");

        // assert that your calculator added the numbers correctly!
        $this->assertEquals('bzB0cmVKTmhUMllrdWZtd1ZlYjZHZz09', $result);
    }

}
