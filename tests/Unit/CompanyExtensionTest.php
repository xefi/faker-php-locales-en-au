<?php

namespace Xefi\Faker\EnAu\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\EnAu\Extensions\CompanyExtension;

final class CompanyExtensionTest extends TestCase
{
    protected array $companies = [];

    protected function setUp(): void
    {
        parent::setUp();

        $companyExtension = new CompanyExtension(new Randomizer());
        $this->companies = (new ReflectionClass($companyExtension))->getProperty('companies')->getValue($companyExtension);
    }

    public function testCompany(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->companies); $i++) {
            $results[] = $this->faker->unique()->company();
        }

        $this->assertEqualsCanonicalizing(
            $this->companies,
            $results
        );
    }

    public function testCompanyNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $acn = $this->faker->companyNumber();

            $this->assertMatchesRegularExpression('/^\d{9}$/', $acn);

            $sum = 0;
            for ($j = 0; $j < 8; $j++) {
                $sum += (int) $acn[$j] * (8 - $j);
            }
            $this->assertSame((10 - $sum % 10) % 10, (int) $acn[8], "ACN {$acn} has an invalid check digit.");
        }
    }

    public function testAbn(): void
    {
        $weights = [10, 1, 3, 5, 7, 9, 11, 13, 15, 17, 19];

        for ($i = 0; $i < 100; $i++) {
            $abn = $this->faker->abn();

            $this->assertMatchesRegularExpression('/^[1-9]\d{10}$/', $abn);

            $digits = array_map('intval', str_split($abn));
            $digits[0]--;

            $sum = 0;
            foreach ($digits as $index => $digit) {
                $sum += $digit * $weights[$index];
            }
            $this->assertSame(0, $sum % 89, "ABN {$abn} has invalid check digits.");
        }
    }

    public function testKnownAbnIsValidatedTheSameWay(): void
    {
        $weights = [10, 1, 3, 5, 7, 9, 11, 13, 15, 17, 19];
        $digits = array_map('intval', str_split('51824753556'));
        $digits[0]--;

        $sum = 0;
        foreach ($digits as $index => $digit) {
            $sum += $digit * $weights[$index];
        }

        $this->assertSame(0, $sum % 89);
    }

    public function testFormattedAbn(): void
    {
        $this->assertMatchesRegularExpression('/^\d{2} \d{3} \d{3} \d{3}$/', $this->faker->abn(true));
    }
}
