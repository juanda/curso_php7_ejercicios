<?php

namespace Acme\TopSecret;

class AES256Crypter extends Crypter{

    private function crypt(string $text, string $oper): string{

        $output = false;
        $encrypt_method = "AES-256-CBC";
   
        $secret_iv = 'This is my secret iv';
        
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ( $oper == 'encrypt' ) {
            $output = openssl_encrypt($text, $encrypt_method, $this->key, 0, $iv);
            $output = base64_encode($output);
        } else if( $oper == 'decrypt' ) {            
            $output = openssl_decrypt(base64_decode($text), $encrypt_method, $this->key, 0, $iv);
        }else{
            throw new \Exception("Operación desconocida: " . $oper);
        }
        return $output;
    }
    
    public function encrypt(string $text): string{                 
        return $this->crypt($text, 'encrypt');
    }

    public function decrypt(string $text): string{
        return $this->crypt($text, 'decrypt');
    }
}