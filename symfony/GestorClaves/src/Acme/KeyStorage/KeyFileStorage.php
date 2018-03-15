<?php
namespace Acme\KeyStorage;

use Acme\TopSecret\Crypter;

class KeyFileStorage implements KeyStorageInterface{

    private $crypter;
    private $key;
    private $dataFilePath;
    private $dataJson;
    private $valid = FALSE;

    public function __construct(Crypter $crypter, ...$options){
        $this->crypter = $crypter;        
        $this->dataFilePath = $options[0];        
    }
    
    public function openDataFile($key){
        
        $this->crypter->setKey($key);
        
        if(!file_exists($this->dataFilePath)){            
            file_put_contents($this->dataFilePath, $this->crypter->encrypt('{}'));
        }

        $data = file_get_contents($this->dataFilePath);
        $decodedData = $this->crypter->decrypt($data);
    
        $this->dataJson = json_decode($decodedData, true);

        if(!isset($this->dataJson) || is_null($this->dataJson)){
            throw new \Exception("El fichero no es un JSON válido. Posiblemente la clave suministrada no sea válida");           
        }       
        
        $this->valid = TRUE;
    }

    public function add(KeyRegister $keyregister): bool{
        try{
            $this->dataJson[$keyregister->name] = [
                'username' => $keyregister->username,
                'password' => $keyregister->password,
                'email' => $keyregister->email,
                'comment' => $keyregister->comment
            ];           
            return $this->save();
        }catch(\Exception $e){
            return false;
        }
                
    }
    
    public function save(): bool{
        $encodedData = $this->crypter->encrypt(json_encode($this->dataJson));
        return file_put_contents($this->dataFilePath, $encodedData);
    }

    public function getAll(): array{
        return $this->dataJson;
    }

    public function find(string $name){
        
        $keyregister = (array_key_exists($name, $this->dataJson))?
             KeyRegister::createFromArray($name, $this->dataJson[$name]):
             NULL;
        
        return $keyregister;
    }
    
    // unset() no devuelve ningún valor, mantendremos ese criterio en el 
    // borrado de elementos.
    public function delete(string $name): bool{
        if(!array_key_exists($name)){
            unset($this->dataJson[$name]);  
            return TRUE;         
        }
        return FALSE;
    }

    public function __destruct(){
        if($this->valid) $this->save();
    }
}