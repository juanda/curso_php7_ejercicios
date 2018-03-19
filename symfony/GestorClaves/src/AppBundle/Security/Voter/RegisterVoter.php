<?php

namespace AppBundle\Security\Voter;

use Acme\KeyStorage\KeyRegister;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class RegisterVoter extends Voter {

    const VIEW = 'view';
    const EDIT = 'edit';

    protected function supports($attribute, $subject): bool {
        if (!in_array($attribute, array(self::VIEW, self::EDIT))) {
            return false;
        }

        if (!$subject instanceof KeyRegister) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool {
        $user = $token->getUser();

        if ($attribute == RegisterVoter::VIEW) {
            return $user->getUsername() == $subject->username;
        }

        if ($attribute == RegisterVoter::EDIT) {
            return ($user->getUsername() == $subject->username && $user->hasRole('ROLE_ADMIN'));
        }
        
        return false;
    }

}
