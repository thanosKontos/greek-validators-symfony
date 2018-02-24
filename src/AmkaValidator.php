<?php

namespace SymfonyGreekValidation;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class AmkaValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (empty($value)) {
            return true;
        }

        if (!preg_match('/^[0-9]{11}$/', $value) || $value === '00000000000') {
            $this->buildViolation($value, $constraint);

            return false;
        }

        $sum = 0;
        foreach(str_split($value) as $index => $char) {
            $tempDigit = intval($char);
            if ($this->isOdd($index)) {
                $tempDigit *= 2;
                if ($tempDigit > 9) {
                    $tempDigit -= 9;
                }
            }

            $sum += $tempDigit;
        }

        if ($sum % 10 !== 0) {
            $this->buildViolation($value, $constraint);

            return false;
        }

        return true;
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