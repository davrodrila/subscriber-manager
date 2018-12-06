<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EmailDomain implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the email domain is from a valid host
     *
     * @param  string  $attribute
     * @param  string  $value An email address
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //This email should have already been checked, will keep the check for peace of mind
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $domain = $this->getDomainFrom($value);
            $hosts = [];
            return getmxrr($domain, $hosts);
        } else {

        }
    }

    public function getDomainFrom($email)
    {
        $domain = substr($email, strrpos($email, '@')+1);
        return $domain;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute host is not active';
    }
}
