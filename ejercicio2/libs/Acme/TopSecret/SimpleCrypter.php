<?php

namespace Acme\TopSecret;

class SimpleCrypter extends Crypter{

    private function crypt(string $str, string $oper): string{
        
        $lenStr = strlen($str);
    
        $lenKey = strlen($this->key);
    
        $strCrypted = "";
        for($i = 0; $i < $lenStr; $i++){
            $j = $i % $lenKey;
    
            if($oper == "encrypt"){
                $strCrypted .= chr(ord($str[$i]) + hexdec($this->key[$j]));
            }elseif($oper == "decrypt"){
                $strCrypted .= chr(ord($str[$i]) - hexdec($this->key[$j]));
            }else{
                throw new \Excepcion("Operación desconocida: " . $oper);
            }
        }
    
        return $strCrypted;
    }

    public function encrypt(string $text): string
    {
        return $this->crypt($text, 'encrypt');
    }

    public function decrypt(string $text): string
    {
        return $this->crypt($text, 'decrypt');
    }
}