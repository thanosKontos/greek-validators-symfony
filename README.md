# Greek valiadtions for symfony

[![Build Status](https://scrutinizer-ci.com/g/thanosKontos/greek-validators-symfony/badges/build.png?b=master)](https://scrutinizer-ci.com/g/thanosKontos/greek-validators-symfony/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/thanosKontos/greek-validators-symfony/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/thanosKontos/greek-validators-symfony/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/thanosKontos/greek-validators-symfony/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/thanosKontos/greek-validators-symfony/?branch=master)

Validations for Αμκα number, αφμ number etc for symfony validator.

At the moment the following validators are available:

* Αφμ
* Αμκα
* Κ.Α.Δ

## Release notes

There is one and only release: 0.1

## Instructions

`composer require thanos-kontos/greek-validators-symfony`

```php
$validator = Validation::createValidator();

$violations = $validator->validate('7865456587', [
    new /SymfonyGreekValidation/Afm(),
    new /Symfony/Component/Validator/Constraints/NotBlank()
]);
```

or

```php
$validator = Validation::createValidator();

$violations = $validator->validate('3545787968765', [
    new /SymfonyGreekValidation/Amka(),
    new /Symfony/Component/Validator/Constraints/NotBlank()
]);
```

## License

SymfonyGreekValidation is released under the [MIT License](https://opensource.org/licenses/MIT).