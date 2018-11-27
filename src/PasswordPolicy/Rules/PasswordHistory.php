<?php

namespace PasswordPolicy\Rules;

use PasswordPolicy\Rule;
use PasswordPolicy\User;

class PasswordHistory implements Rule {

    protected $currentPassword;
    protected $passwordHistory;

    protected $user;

    public function __construct(User $user)
    {
        $this->passwordHistory = $user;
    }

    public function currentPassword($currentPassword)
    {
        $this->currentPassword = $currentPassword ;
        return $this;
    }
    public function passwordHistory($passwordHistory)
    {
        $this->passwordHistory = $passwordHistory ;
        return $this;
    }


    public function test($password)
    {
        if ( in_array($this->currentPassword, $this->passwordHistory->getPasswordHistory()) ){

            return false;
        }

        return true;
    }
}