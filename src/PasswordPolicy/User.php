<?php

namespace PasswordPolicy;

/**
 * Class User
 * @package PasswordPolicy
 */
class User implements PasswordHistory {

    private $passwordHistory;

    public function getPasswordHistory()
    {
        return $this->passwordHistory;
    }

    public function setPasswordHistory($password)
    {
       $this->passwordHistory = $password;

    }


}