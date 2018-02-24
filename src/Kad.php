<?php

namespace SymfonyGreekValidation;

use Symfony\Component\Validator\Constraint;

class Kad extends Constraint
{
    public $message = 'The kad number (κ.α.δ) "{{ string }}" is invalid.';

    public function validatedBy()
    {
        return get_class($this) . 'Validator';
    }
}
