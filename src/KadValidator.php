<?php

namespace SymfonyGreekValidation;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class KadValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (empty($value)) {
            return true;
        }

        if (!preg_match('/^([0-9]{2}\.){3}[0-9]{2}$/', $value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();

            return false;
        }

        return true;
    }
}