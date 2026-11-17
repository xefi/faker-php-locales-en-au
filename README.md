# Faker PHP — en_AU locale

Australian English (`en_AU`) locale for [Faker PHP](https://github.com/xefi/faker-php).

## Installation

```bash
composer require --dev xefi/faker-php-locales-en-au
```

The service provider is discovered automatically through Composer.

## Usage

```php
use Xefi\Faker\Faker;

$faker = new Faker('en_AU');
```

Generators without a `en_AU` variant fall back to the default locale.

## Locale-specific generators

```php
$faker->state();          // 'New South Wales'
$faker->stateCode();      // 'NSW'
$faker->postcode();       // '2000'
$faker->tfn();            // Tax File Number, valid modulus 11 check digit
$faker->medicareNumber(); // Medicare card number with check digit and issue number
$faker->abn();            // Australian Business Number, valid modulus 89 check digits
$faker->companyNumber();  // Australian Company Number (ACN), valid check digit
$faker->bsb();            // '063-123'
```

Australia does not use IBAN: `iban()` returns an IBAN-shaped `AU` string built from a BSB and an account number.

## Contributing

1. Fork the repository and create a branch from `main`.
2. Add an extension under `src/Extensions/` and register it in `FakerEnAuServiceProvider::boot()`.
3. Add a test under `tests/Unit/`.
4. Run the suite with `vendor/bin/phpunit` (or `docker compose run php vendor/bin/phpunit`).
5. Open a pull request against `main`.

## License

MIT
