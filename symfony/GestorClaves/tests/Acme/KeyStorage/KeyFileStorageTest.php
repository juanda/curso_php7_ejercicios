<?php

namespace Test\Acme\KeyStorage;

use Acme\KeyStorage\KeyFileStorage;
use Acme\KeyStorage\KeyRegister;
use Acme\TopSecret\AES256Crypter;
use PHPUnit\Framework\TestCase;

class KeyFileStorageTest extends TestCase {

    const PATH = __DIR__ . '/keytestfile';

    public function tearDown() {
        parent::tearDown();
        if (file_exists(KeyFileStorageTest::PATH)){
            unlink(KeyFileStorageTest::PATH);
        }
    }

    public function testOpenDataFile() {

        $crypter = $this->createMock(AES256Crypter::class);
        $path = KeyFileStorageTest::PATH;
        $keyfileStorage = new KeyFileStorage($crypter, $path);

        $keyfileStorage->save();

        $this->assertFileExists($path);
        $this->assertFileIsReadable($path);
    }

    public function testAdd() {

        $crypter = $this->createMock(AES256Crypter::class);
        $crypter->method('encrypt')->willReturn('mensajeencryptado');
        $path = KeyFileStorageTest::PATH;
        $keyfileStorage = new KeyFileStorage($crypter, $path);

        $register = new KeyRegister('prueba', 'prueba', 'prueba', 'prueba', 'prueba');
        $keyfileStorage->add($register);
        
        $all = $keyfileStorage->getAll();
        
        $keyfileStorage->save();
        
        $filecontent = file_get_contents(KeyFileStorageTest::PATH);

        $this->assertInternalType('array', $all);
        $this->assertArrayHasKey('prueba', $all);
        $this->assertEquals('mensajeencryptado', $filecontent);
        
    }

}
