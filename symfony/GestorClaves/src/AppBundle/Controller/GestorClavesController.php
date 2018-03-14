<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Acme\KeyStorage\KeyFileStorage;
use Acme\KeyStorage\KeyRegister;
use Acme\TopSecret\AES256Crypter;
use AppBundle\Entity\Register;

class GestorClavesController extends Controller {

    /**
     * @Route("/add", name="add")
     */
    public function addAction(KeyFileStorage $keyStorage, Request $request) {

        //$keyStorage = $this->container->get('keystorage');

        $message = null;
        if ($request->getMethod() == "POST") {
            $keyStorage->openDataFile($request->get('key'));

            $register = KeyRegister::createFromRequest($request);

            if ($keyStorage->add($register)) {
                $message = "Registro añadido correctamente";
            } else {
                $message = "No he podido añadir el registro";
            }
        }
        return $this->render('GestorClaves/add.html.twig', array(
                    'message' => $message
        ));
    }

    /**
     * @Route("/list", name="list")
     */
    public function listAction(KeyFileStorage $keyStorage, Request $request) {

        
        $registers = [];
        if ($request->getMethod() == "POST") {            
            $keyStorage->openDataFile($request->get('key'));
            $registers = $keyStorage->getAll();
            dump($registers);
        }

        return $this->render('GestorClaves/list.html.twig', array(
                    'registers' => $registers
        ));
    }

    /**
     * @Route("/delete")
     */
    public function deleteAction() {
        return $this->render('AppBundle:GestorClaves:delete.html.twig', array(
                        // ...
        ));
    }

    /**
     * @Route("/find")
     */
    public function findAction() {
        return $this->render('AppBundle:GestorClaves:find.html.twig', array(
                        // ...
        ));
    }

}
