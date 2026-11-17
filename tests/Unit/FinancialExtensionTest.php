<?php

namespace Xefi\Faker\EnAu\Tests\Unit;

use Xefi\Faker\Calculators\Iban;

final class FinancialExtensionTest extends TestCase
{
    public function testBsb(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^\d{2}[2-7]-\d{3}$/', $this->faker->bsb());
            $this->assertMatchesRegularExpression('/^\d{2}[2-7]\d{3}$/', $this->faker->bsb(false));
        }
    }

    public function testIban(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $iban = $this->faker->iban();

            $this->assertMatchesRegularExpression('/^AU\d{2}\d{2}[2-7]\d{3}\d{9}$/', $iban);
            $this->assertTrue(Iban::isValid($iban));
        }
    }
}
