<?php

namespace SymfonyGreekValidation;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class AfmValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (empty($value)) {
            return true;
        }

        if (!is_numeric($value)) {
            $this->buildViolation($value, $constraint);

            return false;
        }

        $reverseAfm   = array_reverse(str_split($value));
        $first = (int) array_shift($reverseAfm);
        $sum = 0;

        foreach ($reverseAfm as $index => $value) {
            $sum += $value * pow(2, ++$index);
        }

        $mod = $sum % 11;
        if ((10 === $mod && $first === 0) || ($mod === $first)) {
            return true;
        }

        $this->buildViolation($value, $constraint);

        return false;
    }

    private function isOdd($index)
    {
        return $index % 2 === 1;
    }

    private function buildViolation($value, $constraint)
    {
        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ string }}', $value)
            ->addViolation();
    }
}