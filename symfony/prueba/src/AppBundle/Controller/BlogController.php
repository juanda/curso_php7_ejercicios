<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;

class BlogController
{

    public function showAction(\Swift_Mailer $mailer, $slug)
    {
        dump($mailer);
        return new Response("Hola " . $slug);
    }
}
