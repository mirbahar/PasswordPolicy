<?php

namespace PasswordPolicy;

interface PasswordHistory {

    public function getPasswordHistory();
    public function setPasswordHistory($password);
}