<?php

namespace AppBundle\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\Response;

class ExceptionSubscriber implements EventSubscriberInterface {

    public static function getSubscribedEvents() {
        // return the subscribed events, their methods and priorities
        return array(
            KernelEvents::EXCEPTION => array(
                array('onKernelException', 0)
               // array('processException', 10),
               // array('logException', 0),
               // array('notifyException', -10),
               // array('resourceNotFoundException', 20),
            )
        );
    }

    public function processException(GetResponseForExceptionEvent $event) {
        $response = new Response(
                sprintf('<html><body><h1>Proccess Exception</h1><pre>%s</pre></body></html>', print_r($event->getException()->getMessage(), true)));

        $event->setResponse($response);
    }

    public function logException(GetResponseForExceptionEvent $event) {
        $response = new Response(
                sprintf('<html><body><h1>Log Exception</h1><pre>%s</pre></body></html>', print_r($event->getException()->getMessage(), true)));

        $event->setResponse($response);
    }

    public function notifyException(GetResponseForExceptionEvent $event) {
        $response = new Response(
                sprintf('<html><body><h1>Notity Exception</h1><pre>%s</pre></body></html>', print_r($event->getException()->getMessage(), true)));

        $event->setResponse($response);
    }

    public function resourceNotFoundException(GetResponseForExceptionEvent $event) {
        $response = new Response(
                sprintf('<html><body><h1>Not Found Exception</h1><pre>%s</pre></body></html>', print_r($event->getException()->getMessage(), true)));

        $event->setResponse($response);
    }

}
