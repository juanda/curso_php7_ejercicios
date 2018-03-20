<?php

namespace AppBundle\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Acme\KeyStorage\KeyFileStorage;

class GestorClavesControllerSubscriber implements EventSubscriberInterface {

    private $session;
    private $keystorage;


    public function __construct(SessionInterface $session, KeyFileStorage $keyStorage) {        
        $this->session = $session;
        $this->keystorage = $keyStorage;
    }

    public static function getSubscribedEvents() {
        
        // return the subscribed events, their methods and priorities
        return array(
            KernelEvents::CONTROLLER => 'openDataFile'
        );
    }

    public function openDataFile(FilterControllerEvent $event) {
            
        $controller = $event->getController();
        if( !$controller[0] instanceof \AppBundle\Controller\GestorClavesController
                || $controller[1] == 'keyAction'){
            return null;
        }                      
        
        $key = $this->session->get('key');
        if (is_null($key)) { 
            throw new KeyNeededException();     
        }
        $this->keystorage->openDataFile($key);  
    }

}
