<?php

namespace SymfonyGreekValidation;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class KadTest extends TestCase
{
    /**
     * @dataProvider validKadProvider
     */
    public function testValidKads($kad)
    {
        $validator = Validation::createValidator();

        $violations = $validator->validate($kad, [
            new Kad(),
        ]);

        $this->assertEmpty($violations);
    }

    /**
     * @dataProvider invalidKadProvider
     */
    public function testInvalidKads($kad)
    {
        $validator = Validation::createValidator();

        $violations = $validator->validate($kad, [
            new Kad(),
        ]);

        $this->assertNotEmpty($violations);
    }

    public function validKadProvider()
    {
        return [
            [''],
            [null],
            ['01.00.00.00'],
            ['63.11.13.00'],
            ['62.01.11.03'],
            ['61.10.52.01'],
            ['42.91.20.02'],
        ];
    }

    public function invalidKadProvider()
    {
        return [
            ['01000400500'],
            ['01.00.00.0a'],
            ['01.00.00.00.'],
            ['.01.00.00.00'],
            ['1.00.00.00'],
        ];
    }
}
