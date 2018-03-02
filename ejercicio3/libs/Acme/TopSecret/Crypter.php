<?php

namespace Acme\TopSecret;

abstract class Crypter{

    protected $key;

    public function __construct($key){
        $this->key = hash('sha256', $key);
    }

    abstract public function encrypt(string $text): string;

    abstract public function decrypt(string $text): string;
}