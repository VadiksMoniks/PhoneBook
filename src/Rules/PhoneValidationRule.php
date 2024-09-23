<?php

namespace PhoneBook\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneValidationRule implements Rule
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
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //$pattern = "/^\+\d{1,3}\d{7,10}$/";
        $pattern = "/^\+\d{1,3}-\d{3}-\d{3}-\d{4}$/";//"/^\+\d{1,3}\d{7,10}$/";//"/^\+\d{1,3}[-\s]?\d{3}[-\s]?\d{3}[-\s]?\d{4}$";|^\+\d{1,3}\d{7,10}$/";
        return preg_match($pattern, $value) === 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Incorrect phone number. It should be like +38-044-123-4567 where +38 is country code, 044 - city/region code, 123-4567 - unique phone number';
    }
}
