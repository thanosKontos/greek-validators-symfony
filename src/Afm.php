<?php

namespace SymfonyGreekValidation;

use Symfony\Component\Validator\Constraint;

class Afm extends Constraint
{
    public $message = 'The afm number (αφμ) "{{ string }}" is invalid.';

    public function validatedBy()
    {
        return get_class($this) . 'Validator';
    }
}
