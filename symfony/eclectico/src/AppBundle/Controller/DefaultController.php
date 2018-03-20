<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\EclecticaType;
use AppBundle\Entity\Eclectica;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    
    /**
     * @Route("/eclectica", name="eclectica")
     */
    public function eclecticaAction(Request $request){
        
        $eclectica = new Eclectica();
        
        $form = $this->createForm(EclecticaType::class, $eclectica);
       
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->addFlash(
                    'notice', 'Registro añadido correctamente'
            );

            return $this->redirectToRoute('add');
        }

        return $this->render('default/eclectica.html.twig', array(
                    'form' => $form->createView(),
        ));
        
    }
}
