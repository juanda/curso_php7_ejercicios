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
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class LanguageSubscriber implements EventSubscriberInterface {

    private $session;
    private $keystorage;

    public static function getSubscribedEvents() {
        
        // return the subscribed events, their methods and priorities
        return array(
            KernelEvents::REQUEST => ['changeLocale', 17]
        );
    }

    public function changeLocale(GetResponseEvent $event) {
            
        $event->getRequest()->setLocale('fr');
                
                
    }

}
