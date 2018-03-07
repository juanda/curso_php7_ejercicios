<?php
namespace Acme\KeyStorage;

use Acme\TopSecret\Crypter;

class KeyDBStorage implements KeyStorageInterface
{

    private $crypter;
    private $key;
    private $conn;

    public function __construct(Crypter $crypter, ...$options)
    {
        $this->crypter = $crypter;
        $dsn = $options[0];
        $usename = $options[1];
        $password = $options[2];

        try
        {
            $this->conn = new \PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage() . PHP_EOL;
            exit();
        }
    }

    public function add(KeyRegister $keyregister): bool
    {

    }

    public function save(): bool
    {

    }

    public function getAll(): array
    {
    
    }

    public function find(string $name)
    {

    }

    // unset() no devuelve ningún valor, mantendremos ese criterio en el
    // borrado de elementos.
    public function delete(string $name): bool
    {

    }

    public function __destruct()
    {
        if ($this->valid) {
            $this->save();
        }

    }
}
