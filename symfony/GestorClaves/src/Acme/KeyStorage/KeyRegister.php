<?php

namespace Acme\KeyStorage;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Request;

class KeyRegister {

    /**
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    public $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    public $username;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @Assert\Length(
     *      min = 6,
     *      max = 50,
     *      minMessage = "El password debe contener al menos {{ limit }} caracteres",
     *      maxMessage = "El password no puede contener mças de {{ limit }} caracteres"
     * )    
     */
    public $password;

    /**
     * @Assert\Type("string")
     * @Assert\Length(
     *      min = 0,
     *      max = 100,
     * )         
     */
    public $comment;

    /**
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    public $email;

    public function __construct($name = null,
            $username = null,
            $password = null,
            $comment = null,
            $email = null) {

        $this->name = $name;


        $this->username = $username;


        $this->password = $password;


        $this->comment = $comment;

        $this->email = $email;
    }

    static public function createFromArray(string $name, array $item) {
        return new KeyRegister(
                $name, 
                array_key_exists('username', $item) ? $item['username'] : NULL,
                array_key_exists('password', $item) ? $item['password'] : NULL, 
                array_key_exists('comment', $item) ? $item['comment'] : NULL, 
                array_key_exists('email', $item) ? $item['email'] : NULL
        );
    }

    static public function createFromRequest(Request $request) {
        $name = $request->get('name');
        $username = $request->get('username');
        $password = $request->get('password');
        $comment = $request->get('comment');
        $email = $request->get('email');       

        return new KeyRegister($name, $username, $password, $comment, $email);
    }
}
