<?php

namespace PasswordPolicy\Rules;

use PasswordPolicy\Rule;

class PasswordHistory implements Rule {

    protected $notIn = [];


    public function notIn($notIn = [] )
    {
        $this->notIn = $notIn;
        return $this;
    }


    public function test($password)
    {
        if ( in_array($password, $this->notIn) ){
            return false;
        }

        return true;
    }
}