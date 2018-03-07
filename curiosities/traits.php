<?php

trait Hello
{
    public function sayHello()
    {
        echo $this->name . PHP_EOL;
        echo $this->nombre . PHP_EOL;
    }
}

trait World
{
    public function sayWorld()
    {
        echo 'World';
    }
}

class MyHelloWorld
{
    use Hello, World;
   public $nombre;

    public function __construct(){
        $this->nombre = 'juan';
        $this->kaka = 5;
    }

    public function sayExclamationMark()
    {
        echo $this->kaka;
    }
}

echo $a ;
$o = new MyHelloWorld();
$o->sayHello();
$o->sayWorld();
$o->sayExclamationMark();