<?php

namespace AppBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {                
        
        $response = new Response(
                sprintf('<html><body><h1>Exception</h1><pre>%s</pre></body></html>',
                        print_r($event->getException()->getMessage(), true)));
        
        
        $event->setResponse($response);
        
        
    }
}
