<?php

function _readline($prompt){
    if (PHP_OS == 'WINNT') {
        echo $prompt . ' ';
        $line = stream_get_line(STDIN, 1024, PHP_EOL);
      } else {
        $line = readline($prompt . ' ');
      }

      return $line;
}

// ya existe una función crypt en PHP, así que la llamo _crypt
function _crypt(string $str, string $key, string $oper): string {
    $md5Key = md5($key);
    $lenStr = strlen($str);

    $lenMd5Key = strlen($md5Key);

    $strCrypted = "";
    for($i = 0; $i < $lenStr; $i++){
        $j = $i % $lenMd5Key;
        
        if($oper == "encrypt"){
            $strCrypted .= chr(ord($str[$i]) + hexdec($md5Key[$j]));
        }elseif($oper == "decrypt"){
            $strCrypted .= chr(ord($str[$i]) - hexdec($md5Key[$j]));
        }else{
            throw new \Excepcion("Operación desconocida: " . $oper);
        }
    }

    return $strCrypted;
}

function encrypt(string $text, string $key): string {
    return _crypt($text, $key, 'encrypt');
}

function decrypt(string $text, string $key): string {
    return _crypt($text, $key, 'decrypt');
}

