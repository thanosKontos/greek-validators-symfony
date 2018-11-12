<?php

namespace SymfonyGreekValidation;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class AmkaValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof Amka) {
            throw new UnexpectedTypeException($constraint, Amka::class);
        }

        if (empty($value)) {
            return;
        }

        if (!preg_match('/^[0-9]{11}$/', $value) || $value === '00000000000') {
            $this->buildViolation($value, $constraint);
            return;
        }

        $checksum = $this->calculateChecksum($value);

        if ($checksum % 10 !== 0) {
            $this->buildViolation($value, $constraint);
            return;
        }
    }

    private function calculateChecksum(string $amka): int
    {
        $sum = 0;
        foreach (str_split($amka) as $index => $char) {
            $tempDigit = intval($char);
            if ($this->isOdd($index)) {
                $tempDigit *= 2;
                if ($tempDigit > 9) {
                    $tempDigit -= 9;
                }
            }

            $sum += $tempDigit;
        }

        return $sum;
    }

    private function isOdd($index): bool
    {
        return $index % 2 === 1;
    }

    private function buildViolation($value, $constraint): void
    {
        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ string }}', $value)
            ->addViolation();
    }
}