# Greek valiadtions for symfony

Validations for Αμκα number, αφμ number etc for symfony validator.

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