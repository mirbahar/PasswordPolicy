<?php

namespace PasswordPolicy;

interface Rule
{
    public function test($password);
}