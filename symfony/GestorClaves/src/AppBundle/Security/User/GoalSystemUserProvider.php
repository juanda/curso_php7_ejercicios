<?php

namespace AppBundle\Security\User;

use AppBundle\Security\User\GoalSystemUser;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class GoalSystemUserProvider implements UserProviderInterface
{
    public function loadUserByUsername($token)
    {
        // make a call to your webservice here
        $userFile = file_get_contents(__DIR__ . '/users.json');
        $userJson = json_decode($userFile, true);
        
        if (array_key_exists($token, $userJson)) {            

            $username = $userJson[$token]['username'];
            $roles = $userJson[$token]['roles'];
            return new GoalSystemUser($username, '', '', $roles);
        }
                
        throw new UnauthorizedHttpException(sprintf('No existe usuario con el token "%s" ', $token));
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof GoalSystemUser) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return GoalSystemUser::class === $class;
    }
}