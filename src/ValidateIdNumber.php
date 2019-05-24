<?php

namespace SoftWorks\IranianIdNumber;

use Laravel\Nova\Nova;
use Illuminate\Contracts\Validation\Rule;
use Laravel\Nova\Http\Requests\NovaRequest;

class ValidateIdNumber implements Rule
{
    /**
     * The request instance.
     *
     * @var \Laravel\Nova\Http\Requests\NovaRequest
     */
    public $request;

    /**
     * The query builder instance.
     *
     * @var \Illuminate\Database\Eloquent\Builder
     */
    public $query;

    /**
     * Create a new rule instance.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function __construct(NovaRequest $request, $query)
    {
        $this->query = $query;
        $this->request = $request;
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
      $validator = new IdNumberValidator($value);
      return $validator->validate();
    }


    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid ID number';
    }
}
