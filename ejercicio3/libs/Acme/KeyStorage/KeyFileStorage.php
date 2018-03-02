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

        if(!file_exists($this->dataFilePath)){            
            file_put_contents($this->dataFilePath, $crypter->encrypt('{}'));
        }


        $data = file_get_contents($this->dataFilePath);
        $decodedData = $this->crypter->decrypt($data);
    
        $this->dataJson = json_decode($decodedData, true);

        if(!isset($this->dataJson) || is_null($this->dataJson)){
            echo "El fichero no es un JSON válido. Posiblemente la clave suministrada no sea válida";
            echo PHP_EOL;            
            exit;
        }       
        
        $this->valid = TRUE;
    }

    public function add(KeyRegister $keyregister): bool{
        try{
            $this->dataJson[$keyregister->name] = [
                'username' => $keyregister->name,
                'password' => $keyregister->password,
                'comment' => $keyregister->comment
            ];
            return true;
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
        $item = array_search($name, $this->dataJson);        
        if(!$item){
            return null;
        }

        $keyregister = KeyRegister::createFromArray($name, $item);
        
        return $keyregister;
    }
    
    // unset() no devuelve ningún valor, mantendremos ese criterio en el 
    // borrado de elementos.
    public function delete(KeyRegister $keyregister): bool{
        if(!array_key_exists($keyregister->name)){
            unset($this->dataJson[$keyregister->name]);           
        }
    }

    public function __destruct(){
        if($this->valid) $this->save();
    }
}