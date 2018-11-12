<?php

namespace SymfonyGreekValidation;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class KadValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof Kad) {
            throw new UnexpectedTypeException($constraint, Kad::class);
        }

        if (empty($value)) {
            return;
        }

        if (!preg_match('/^([0-9]{2}\.){3}[0-9]{2}$/', $value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();

            return;
        }
    }
}