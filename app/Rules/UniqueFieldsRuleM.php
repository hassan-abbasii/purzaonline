<?php

namespace App\Rules;

use App\Models\service;
use Illuminate\Contracts\Validation\Rule;

class UniqueFieldsRuleM implements Rule
{
    protected $parameters;

    public function __construct(...$parameters)
    {
        $this->parameters = $parameters;
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
        // Get the values of other fields
         
        $ccId = $this->parameters[0];
        $mechanicId = $this->parameters[1];
        $serviceId = $this->parameters[2];
        $shopId = $this->parameters[3];

        // Check for duplicate records
        $count = service::where([
             
            ['cc_id', $ccId],
            ['mechanic_id', $mechanicId],
            ['service_id', $serviceId],
            ['shop_id', $shopId],
            ['isDeleted', false],
        ])->count();

        // If count is 0, it means no duplicate records were found
        return $count === 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
