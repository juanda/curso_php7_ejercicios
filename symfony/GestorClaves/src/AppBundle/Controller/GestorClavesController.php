<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Acme\KeyStorage\KeyFileStorage;
use Acme\KeyStorage\KeyRegister;
use Acme\TopSecret\AES256Crypter;

class GestorClavesController extends Controller {

    /**
     * @Route("/add", name="add")
     */
    public function addAction(Request $request) {
        $keyfile = $this->getParameter('keyfile');

        $message = null;
        if ($request->getMethod() == "POST") {
            $name = $request->get('name');
            $username = $request->get('username');
            $password = $request->get('password');
            $comment = $request->get('comment');
            $key = $request->get('key');

            $crypter = new AES256Crypter($key);

            $register = KeyRegister::createFromArray($name, [
                        'username' => $username,
                        'password' => $password,
                        'comment' => $comment,
            ]);

            $keyStorage = new KeyFileStorage($crypter, $keyfile);

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
