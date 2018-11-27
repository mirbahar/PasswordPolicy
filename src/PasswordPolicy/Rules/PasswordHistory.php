<?php

namespace PasswordPolicy\Rules;

use PasswordPolicy\Rule;

class PasswordHistory implements Rule {

    protected $notIn;

    public function notIn($password)
    {
        $this->notIn = $password->getPasswordHistory();
        return $this;
    }

    public function test($password)
    {
        if ( in_array($password, $this->notIn) )
        {
            return false;
        }

        return true;
    }

}