<?php
namespace Acme\KeyStorage;

class KeyRegister{

    public $name;
    public $username;
    public $password;
    public $comment;

    public function __construct($name, $username, $password, $comment){
        $this->name = $name;
        $this->username = $username;
        $this->password = $password;
        $this->comment = $comment;        
    }

    static public function createFromArray(string $name, array $item){
        return new KeyRegister(
            $name,
            array_key_exists('username', $item)? $item['username'] : NULL,
            array_key_exists('password', $item)? $item['password'] : NULL,
            array_key_exists('comment', $item)? $item['comment'] : NULL
        );
    }
}