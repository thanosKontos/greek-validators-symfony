<?php

namespace SymfonyGreekValidation;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class AmkaTest extends TestCase
{
    /**
     * @dataProvider validAmkaProvider
     */
    public function testValidAmkas($amka)
    {
        $validator = Validation::createValidator();

        $violations = $validator->validate($amka, [
            new Amka(),
        ]);

        $this->assertEmpty($violations);
    }

    /**
     * @dataProvider invalidAmkaProvider
     */
    public function testInvalidAmkas($amka)
    {
        $validator = Validation::createValidator();

        $violations = $validator->validate($amka, [
            new Amka(),
        ]);

        $this->assertNotEmpty($violations);
    }

    public function validAmkaProvider()
    {
        return [
            [''],
            [null],
            ['10128702759'],
            ['15098801044'],
            ['23048800603'],
            ['21118303029'],
            ['20058202241'],
            ['21028901292'],
            ['04038204386'],
            ['11028603410'],
            ['21047602343'],
            ['23108202864'],
            ['12016101078'],
            ['30038700073'],
            ['06118202719'],
            ['28099002389'],
        ];
    }

    public function invalidAmkaProvider()
    {
        return [
            ['10128702758'],
            ['15098801045'],
            ['00000000000'],
            ['2111830302g'],
            ['2111830'],
        ];
    }
}
