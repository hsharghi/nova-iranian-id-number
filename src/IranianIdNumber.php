<?php

namespace SoftWorks\IranianIdNumber;

use Laravel\Nova\Fields\Field;

class IranianIdNumber extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'iranian_id_number';

    /**
     * Create a new IranianIdNumber Field.
     *
     * @param  string  $name
     * @param  string|null  $attribute
     * @param  mixed|null  $resolveCallback
     * @return void
     */
    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this
        ->creationRules(new IdNumberValidator('1231'))
        ->updateRules(new IdNumberValidator('23434'));

    }
}
