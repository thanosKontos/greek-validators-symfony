<?php

namespace SymfonyGreekValidation;

use Symfony\Component\Validator\Constraint;

class Amka extends Constraint
{
    public $message = 'The amka number (αμκα) "{{ string }}" is invalid.';

    public function validatedBy()
    {
        return get_class($this) . 'Validator';
    }
}
