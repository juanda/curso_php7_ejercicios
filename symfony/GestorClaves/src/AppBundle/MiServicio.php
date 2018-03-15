<?php

namespace AppBundle;

class MiServicio{
    
    private $logger;
    public function __construct(\Psr\Log\LoggerInterface $logger) {
        $this->logger = $logger;
    }
    
    public function get(){
        $this->logger->debug("Hola");
        return "Soy el servicio MiServicio";        
    }
    
}

