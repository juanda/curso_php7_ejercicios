<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Acme\KeyStorage\KeyFileStorage;
use Acme\KeyStorage\KeyRegister;

class GestorClavesController extends Controller {

    /**
     * @Route("/reset_key", name="reset_key")
     */
    public function resetSession(SessionInterface $session) {
        $session->clear();
        $this->addFlash(
                'notice', 'Clave reseteada'
        );
        return $this->redirectToRoute('key');
    }

    /**
     * @Route("/key", name="key")
     */
    public function keyAction(KeyFileStorage $keyStorage, SessionInterface $session, Request $request) {
        if ($request->getMethod() == "POST") {
            try {
                $key = $request->get('key');
                $keyStorage->openDataFile($key);
                $session->set('key', $key);

                $this->addFlash(
                        'notice', 'Clave correcta'
                );

                return $this->redirectToRoute('list');
            } catch (\Exception $e) {
                return $this->render('GestorClaves/key.html.twig', [
                            'json_invalid' => $e->getMessage()
                ]);
            }
        }

        return $this->render('GestorClaves/key.html.twig');
    }

    /**
     * @Route("/add", name="add")
     */
    public function addAction(
    KeyFileStorage $keyStorage, ValidatorInterface $validator, SessionInterface $session, Request $request) {

        $key = $session->get('key');        
        if (is_null($key)) {
            return $this->redirectToRoute('key');
        }        
        $keyStorage->openDataFile($key);

        $errors = null;
        if ($request->getMethod() == "POST") {

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

        return $this->render('GestorClaves/add.html.twig');
    }

    /**
     * @Route("/list", name="list")
     */
    public function listAction(KeyFileStorage $keyStorage, SessionInterface $session, Request $request) {

        $key = $session->get('key');

        if (is_null($key)) {
            return $this->redirectToRoute('key');
        }

        $keyStorage->openDataFile($key);

        $registers = $keyStorage->getAll();

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
