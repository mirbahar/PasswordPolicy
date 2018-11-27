<?php namespace PasswordPolicy\Rules;

use PasswordPolicy\Rule;

/**
 * Class BlackList
 */
class BlackList implements Rule
{
    /**
     * password too common
     *
     * @var array
     */
    private $blackLists = [];

    public function blackList($blackList = [])
    {
        $this->blackLists = $blackList;
        return $this;
    }

    /**
     * Test a rule
     *
     * @param $subject
     *
     * @return bool
     */
    public function test($subject)
    {
        if (in_array($subject, $this->blackLists)) {
            return false;
        }
        return true;
    }
}
