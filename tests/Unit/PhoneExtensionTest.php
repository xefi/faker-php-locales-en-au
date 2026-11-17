<?php

namespace Xefi\Faker\EnAu\Tests\Unit;

final class PhoneExtensionTest extends TestCase
{
    public function testPhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^0([2378]\d{8}|4\d{8})$/', $this->faker->phoneNumber());
        }
    }

    public function testCellPhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^04\d{8}$/', $this->faker->cellPhoneNumber());
            $this->assertMatchesRegularExpression('/^04\d{2} \d{3} \d{3}$/', $this->faker->spacedCellPhoneNumber());
        }
    }

    public function testLandlinePhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^0[2378]\d{8}$/', $this->faker->landlinePhoneNumber());
            $this->assertMatchesRegularExpression('/^0[2378] \d{4} \d{4}$/', $this->faker->spacedLandlinePhoneNumber());
        }
    }

    public function testIndicatoredPhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^\+61[23478]\d{8}$/', $this->faker->indicatoredPhoneNumber());
            $this->assertMatchesRegularExpression('/^\+61 4\d{2} \d{3} \d{3}$/', $this->faker->spacedIndicatoredCellPhoneNumber());
            $this->assertMatchesRegularExpression('/^\+61 [2378] \d{4} \d{4}$/', $this->faker->spacedIndicatoredLandlinePhoneNumber());
        }
    }
}
