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

        $reverseAfm = array_reverse(str_split($value));
        $lastDigit = (int) array_shift($reverseAfm);
        $checksum = $this->calculateChecksum($reverseAfm);
        $mod = $checksum % 11;

        if ($this->checkModAgainstLastDigit($mod, $lastDigit)) {
            return true;
        }

        $this->buildViolation($value, $constraint);

        return false;
    }

    private function checkModAgainstLastDigit($mod, $lastDigit): bool
    {
        return (10 === $mod && $lastDigit === 0) || ($mod === $lastDigit);
    }

    private function calculateChecksum($reverseAfm): int
    {
        $checksum = 0;
        foreach ($reverseAfm as $index => $value) {
            $checksum += $value * pow(2, ++$index);
        }

        return $checksum;
    }

    private function buildViolation($value, $constraint): void
    {
        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ string }}', $value)
            ->addViolation();
    }
}