<?php

namespace AppBundle\Entity;
use Symfony\Component\Validator\Constraint as Assert;

class Register {
    private $name;
    private $username;
    private $password;
    private $comment;
    private $email;
    private $key;

    
    public function __construct($name, $username, $password, $comment, $email, $key){
        $this->name = $name;
        $this->username = $username;
        $this->password = $password;
        $this->comment = $comment;
        $this->email = $email;
        $this->key = $key;                
    }
    
    public static function createRegister(\Symfony\Component\HttpFoundation\Request $request){
        $name = $request->get('name');
        $username = $request->get('username');
        $password = $request->get('password');
        $comment = $request->get('comment');
        $email = $request->get('email');
        $key = $request->get('key');   
        
        return new Register($name, $username, $password, $comment, $email, $key);
    }

    /**
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * 
     * @return type
     */
    function getName() {
        return $this->name;
    }

     /**
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * 
     * @return type
     */
    function getUsername() {
        return $this->username;
    }
    
     /**
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @Assert\Length(
     *      min = 6,
     *      max = 50,
     *      minMessage = "El password debe contener al menos {{ limit }} caracteres",
     *      maxMessage = "El password no puede contener mças de {{ limit }} caracteres"
     * )
     * @return type
     */
    function getPassword() {
        return $this->password;
    }
    
    /**
     * @Assert\Type("string")
     * @Assert\Length(
     *      min = 0,
     *      max = 100,
     * )
     * @return type
     */
    function getComment() {
        return $this->comment;
    }
    
     /**
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @Assert\Length(
     *      min = 6,
     *      max = 50,
     * )
     * @return type
     */
    function getKey() {
        return $this->key;
    }
   
    /**
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     * @return type
     */
    function getEmail() {
        return $this->email;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setComment($comment) {
        $this->comment = $comment;
    }

    function setKey($key) {
        $this->key = $key;
    }
    
    

    function setEmail($email) {
        $this->email = $email;
    }




    
}
