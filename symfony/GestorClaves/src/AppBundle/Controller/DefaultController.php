<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(\AppBundle\MiServicio $miservicio, Request $request)
    {
        $text = $miservicio->get();
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            //'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'base_dir' => $text ,
        ]);
    }
    
    /**
     * @Route("/admin", name="admin")
     */
    public function AdminAction(\AppBundle\MiServicio $miservicio, Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');
        $user = $this->getUser();
        
        return new Response(sprintf('<html><body>Administración. user: <pre>%s</pre></body></html>', print_r($user, true)));
                
    }
    
    /**
     * @Route("/goalsystem/hello", name="goalsystem_hello")
     */
    public function HelloAction(\AppBundle\MiServicio $miservicio, Request $request)
    {
        $user = $this->getUser();
        
        return new Response(sprintf('<html><body>Hola <pre>%s</pre></body></html>', print_r($user, true)));
                
    }
    
    /**
     * @Route("/traduccion", name="traduccion")
     */
    public function TraduccionAction(TranslatorInterface $translator)
    {
        echo $translator->trans('Gestor de Claves');
        echo '<br>';
        echo $translator->trans('Sin traducir');
        
        return new Response('<html><body></body></html>');                
    }
}
