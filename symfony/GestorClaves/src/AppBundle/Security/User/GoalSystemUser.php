<?php

namespace AppBundle\Security\User;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

class GoalSystemUser implements UserInterface, EquatableInterface
{
    private $username;   
    private $roles;

    public function __construct($username, array $roles, array $properties)
    {
        $this->username = $username;               
        $this->roles = $roles;
        $this->properties = $properties;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function getPassword()
    {
        return NULL;
    }

    public function getSalt()
    {
        return NULL;
    }

    public function getUsername()
    {
        return $this->username;
    }
    
    public function getProperties(){
        return $this->properties;        
    }

    public function eraseCredentials()
    {
    }

    public function isEqualTo(UserInterface $user)
    {
        if (!$user instanceof WebserviceUser) {
            return false;
        }

        if ($this->password !== $user->getPassword()) {
            return false;
        }

        if ($this->salt !== $user->getSalt()) {
            return false;
        }

        if ($this->username !== $user->getUsername()) {
            return false;
        }

        return true;
    }
}