<?php

require "../../vendor/autoload.php";

// namespace PasswordPolicy;
use PasswordPolicy\Policy;
use PasswordPolicy\Rules\BlackList;
use PasswordPolicy\Rules\CaseRule;
use PasswordPolicy\Rules\Digit;
use PasswordPolicy\Rules\Length;
use PasswordPolicy\Rules\PasswordHistory;
use PasswordPolicy\Rules\SpecialCharacter;
use PasswordPolicy\User;

class PolicyBuilder
{
    /**
     * Policy instance
     *
     * @var Policy
     */
    private $policy;

    private $errors = [];


    public function __construct(Policy $policy)
    {
        $this->policy = $policy;

    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param $password
     * @return mixed
     */
    public function minLength($password)
    {
        $this->policy->addRule((new Length())->min($password));
        $this->errors['minLength'] = "Password must be at least $password characters long";

        return $this;
    }

    /**
     * @param $password
     * @return mixed
     */
    public function maxLength($password)
    {
        $this->policy->addRule((new Length())->max($password));
        $this->errors['maxLength'] = "Password must be at most $password characters long";

        return $this;
    }

    /**
     * @param $password
     * @return mixed
     */
    public function minDigit($password)
    {
        $this->policy->addRule((new Digit)->min($password));
        return $this;
    }

    /**
     * @param $password
     * @return mixed
     */
    public function specialCharacter($password)
    {
        $this->policy->addRule((new SpecialCharacter)->min($password));
        return $this;
    }

    /**
     * @param $password
     * @return mixed
     */
    public function upperCase($password)
    {
        $this->policy->addRule((new CaseRule)->upper($password));
        return $this;
    }

    /**
     * @param $password
     * @return mixed
     */
    public function lowerCase($password)
    {
        $this->policy->addRule((new CaseRule)->lower($password));
        return $this;
    }

    /**
     * @param $password
     * @return mixed
     */
    public function blackList($password)
    {
        $this->policy->addRule((new BlackList)->blackList($password));
        return $this;
    }
    /**
     * @param $password
     * @return mixed
     */
    public function notIn($password)
    {
        $this->policy->addRule((new PasswordHistory())->notIn($password));
        return $this;
    }

    public function getPolicy()
    {
        return $this->policy;
    }

    public function checkPassword($password)
    {
        foreach ($this->policy->rules() as $rule) {

            if (!$rule->test($password))
            {
                 return false;
            }
        }

        return true;
    }
}
$user = new User();
$user->setPasswordHistory(['1AAaa!', 'dddd']);

$builder = new PolicyBuilder(new Policy());
$builder->minDigit(1)
        ->minLength(2)
        ->maxLength(8)
        ->specialCharacter(1)
        ->upperCase(2)
        ->lowerCase(2)
        ->blackList(['RRdd11!', 'RRdd11!d'])
        ->notIn($user);  // user previous password history array e.g ['1AAaa!', 'dddd']

$builder->checkPassword('1AAaa!');
