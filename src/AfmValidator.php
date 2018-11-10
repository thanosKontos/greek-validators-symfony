<?php

namespace SymfonyGreekValidation;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class AfmValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof Afm) {
            throw new UnexpectedTypeException($constraint, Afm::class);
        }

        if (empty($value)) {
            return;
        }

        if (!is_numeric($value)) {
            $this->buildViolation($value, $constraint);
            return;
        }

        $reverseAfm = array_reverse(str_split($value));
        $lastDigit = (int)array_shift($reverseAfm);
        $checksum = $this->calculateChecksum($reverseAfm);
        $mod = $checksum % 11;

        if ($this->checkModAgainstLastDigit($mod, $lastDigit)) {
            return;
        }

        $this->buildViolation($value, $constraint);
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