<?php

namespace AppBundle\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class LanguageSubscriber implements EventSubscriberInterface {

    private $session;
    private $keystorage;

    public static function getSubscribedEvents() {
        
        // return the subscribed events, their methods and priorities
        return array(
            KernelEvents::REQUEST => ['changeLocale', 0]
        );
    }

    public function changeLocale(GetResponseEvent $event) {
            
        $event->getRequest()->setLocale('en');
                
                
    }

}
