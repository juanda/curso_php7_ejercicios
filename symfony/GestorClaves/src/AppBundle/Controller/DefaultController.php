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
    
    /**
     * @Route("/relaciones", name="relacione")
     */
    
    public function relacionesAction(){
        $em = $this->getDoctrine()->getManager();
                
        $grupo = new \AppBundle\Entity\Grupo();
        $grupo->setNombre('g4');
        
        $grupo2 = new \AppBundle\Entity\Grupo();
        $grupo2->setNombre('g5');
        
        $grupo3 = new \AppBundle\Entity\Grupo();
        $grupo3->setNombre('g6');
        
        $persona = new \AppBundle\Entity\Persona();
        $persona->setNombre('juanito2');
        
        $persona2 = new \AppBundle\Entity\Persona();
        $persona2->setNombre('pepito2');
        
        $persona->addGrupo($grupo);
        $persona->addGrupo($grupo2);
        
        $persona2->addGrupo($grupo);
        $persona2->addGrupo($grupo3);
        
        $em->persist($persona);
        $em->persist($persona2);
        
        $em->flush();
        
        return new Response('<html><body></body></html>');    
        
    }
    
    /**
     * @Route("/dql", name="dql")
     */
    function dqlAction(){
        $em = $this->getDoctrine()->getManager();
                
//        $dql = <<< DQL
//select f,a from AppBundle:Film f JOIN f.actor a where a.firstName LIKE :firstname AND f.releaseYear > :year
//DQL;
//        
//        $query = $em->createQuery($dql)->setParameters([
//            'firstname' => '%JOHN%',
//            'year' => '1980'
//        ]);
//        
        
//        $query = $em->createQueryBuilder()
//            ->select('a')
//            ->from('AppBundle:Actor', 'a')
//            ->where('a.firstName LIKE :patron')
//            ->setParameter('patron', 'A%')
//            ->getQuery();

        
        $actors = $em->getRepository('AppBundle:Actor')->findByNombreLike('%JOHN%');
        
//        foreach ($films as $film){
//            echo '<b>' . $film->getTitle() . '</b><br>';
//            $actors = $film->getActor();
//            foreach ($actors as $actor){
//                echo $actor->getFirstName() . ' ' . $actor->getLastName() . '<br>';
//            }
//        }
//        
        dump($actors);
        
        return new Response('<html><body></body></html>');
    }
}
