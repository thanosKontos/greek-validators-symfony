<?php

namespace SymfonyGreekValidation;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class AfmTest extends TestCase
{
    /**
     * @dataProvider validAfmProvider
     */
    public function testValidAfms($afm)
    {
        $validator = Validation::createValidator();

        $violations = $validator->validate($afm, [
            new Afm(),
        ]);

        $this->assertEmpty($violations);
    }

    /**
     * @dataProvider invalidAfmProvider
     */
    public function testInvalidAfms($afm)
    {
        $validator = Validation::createValidator();

        $violations = $validator->validate($afm, [
            new Afm(),
        ]);

        $this->assertNotEmpty($violations);
    }

    public function validAfmProvider()
    {
        return [
            ['094075243'],
            ['094079531'],
            ['997364193'],
            ['800785347'],
            ['094066928'],
            ['084256593'],
        ];
    }

    public function invalidAfmProvider()
    {
        return [
            ['026051931'],
            ['aaaa'],
            [''],
            [null]
        ];
    }
}
