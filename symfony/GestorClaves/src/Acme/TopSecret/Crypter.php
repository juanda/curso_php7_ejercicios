<?php

namespace Acme\TopSecret;

abstract class Crypter{

    protected $key;
     
    public function setKey($key){
        $this->key = hash('sha256', $key);
    }

    abstract public function encrypt(string $text): string;

    abstract public function decrypt(string $text): string;
}