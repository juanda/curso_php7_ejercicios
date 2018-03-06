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