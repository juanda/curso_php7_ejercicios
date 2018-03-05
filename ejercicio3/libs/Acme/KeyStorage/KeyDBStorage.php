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
            $$this->conn = new \PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage() . PHP_EOL;
            exit();
        }

        // check key

        $this->valid = true;
    }

    private function checkKey()
    {
        $sql = "SELECT * from clave";
        $pdo_statement_object = $pdo_object->prepare($sql);
        $pdo_statement_object->execute();
        $result = $pdo_statement_object->fetchAll();

    }

    public function add(KeyRegister $keyregister): bool
    {
        try {
            $this->dataJson[$keyregister->name] = [
                'username' => $keyregister->username,
                'password' => $keyregister->password,
                'comment' => $keyregister->comment,
            ];
            return true;
        } catch (\Exception $e) {
            return false;
        }

    }

    public function save(): bool
    {
        $encodedData = $this->crypter->encrypt(json_encode($this->dataJson));
        return file_put_contents($this->dataFilePath, $encodedData);
    }

    public function getAll(): array
    {
        return $this->dataJson;
    }

    public function find(string $name)
    {

        $keyregister = (array_key_exists($name, $this->dataJson)) ?
        KeyRegister::createFromArray($name, $this->dataJson[$name]) :
        null;

        return $keyregister;
    }

    // unset() no devuelve ningún valor, mantendremos ese criterio en el
    // borrado de elementos.
    public function delete(KeyRegister $keyregister): bool
    {
        if (!array_key_exists($keyregister->name)) {
            unset($this->dataJson[$keyregister->name]);
        }
    }

    public function __destruct()
    {
        if ($this->valid) {
            $this->save();
        }

    }
}
