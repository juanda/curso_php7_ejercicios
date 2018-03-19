<?php

namespace AppBundle\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Acme\KeyStorage\KeyFileStorage;
use Symfony\Component\HttpFoundation\RedirectResponse;
use  Symfony\Component\Routing\RouterInterface;

class GestorClavesControllerSubscriber implements EventSubscriberInterface {

    private $session;
    private $keystorage;


    public function __construct(SessionInterface $session, KeyFileStorage $keyStorage, RouterInterface $router) {        
        $this->session = $session;
        $this->keystorage = $keyStorage;
        $this->router = $router;
        
    }

    public static function getSubscribedEvents() {
        
        // return the subscribed events, their methods and priorities
        return array(
            KernelEvents::CONTROLLER => 'openDataFile'
        );
    }

    public function openDataFile(FilterControllerEvent $event) {
            
        $controller = $event->getController();
        if( !$controller[0] instanceof \AppBundle\Controller\GestorClavesController){
            return null;
        }                      
        
        $key = $this->session->get('key');
        if (is_null($key)) {            
            return new RedirectResponse($this->router->generate('key'));
        }
        $this->keystorage->openDataFile($key);
                
    }

}
