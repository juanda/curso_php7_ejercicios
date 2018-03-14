<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Acme\KeyStorage\KeyFileStorage;
use Acme\KeyStorage\KeyRegister;

class GestorClavesController extends Controller {

    /**
     * @Route("/add", name="add")
     */
    public function addAction(
    KeyFileStorage $keyStorage, ValidatorInterface $validator, Request $request) {
       
        $errors = null;
        if ($request->getMethod() == "POST") {           
            try {
                $keyStorage->openDataFile($request->get('key'));
            } catch (\Exception $e) {                          
                return $this->render('GestorClaves/add.html.twig', [
                            'json_invalid' => $e->getMessage()
                ]);
            }

            $register = KeyRegister::createFromRequest($request);
            $errors = $validator->validate($register);
            if (count($errors) > 0) {
                return $this->render('GestorClaves/add.html.twig', [
                            'errors' => $errors
                ]);
            } else if ($keyStorage->add($register)) {
                $this->addFlash(
                        'notice', 'Registro añadido correctamente'
                );
            } 

            return $this->redirectToRoute('add');
        }

        return $this->render('GestorClaves/add.html.twig', [
                    'errors' => $errors
        ]);
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
