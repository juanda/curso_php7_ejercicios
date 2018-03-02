<?php
namespace Acme\KeyStorage;

use Acme\KeyStorage\KeyRegister;
use Acme\TopSecret\Crypter;

Interface KeyStorageInterface{

    public function __construct(Crypter $crypter, ...$options);
    
    public function add(KeyRegister $keyregister): bool;
    public function save(): bool;
    public function find(string $name);
    public function getAll(): array;
    public function delete(KeyRegister $keyregister): bool;        
}
