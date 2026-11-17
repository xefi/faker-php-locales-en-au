<?php

namespace Xefi\Faker\EnAu\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\EnAu\Extensions\AddressExtension;

final class AddressExtensionTest extends TestCase
{
    protected array $states = [];
    protected array $postcodeRanges = [];
    protected array $cities = [];
    protected array $streetTypes = [];
    protected array $streetNames = [];

    protected function setUp(): void
    {
        parent::setUp();

        $addressExtension = new AddressExtension(new Randomizer());
        $reflection = new ReflectionClass($addressExtension);

        $this->states = $reflection->getProperty('states')->getValue($addressExtension);
        $this->postcodeRanges = $reflection->getProperty('postcodeRanges')->getValue($addressExtension);
        $this->cities = $reflection->getProperty('cities')->getValue($addressExtension);
        $this->streetTypes = $reflection->getProperty('streetTypes')->getValue($addressExtension);
        $this->streetNames = $reflection->getProperty('streetNames')->getValue($addressExtension);
    }

    public function testState(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->states); $i++) {
            $results[] = $this->faker->unique()->state();
        }

        $this->assertEqualsCanonicalizing(
            array_keys($this->states),
            $results
        );
    }

    public function testStateCode(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->states); $i++) {
            $results[] = $this->faker->unique()->stateCode();
        }

        $this->assertEqualsCanonicalizing(
            array_values($this->states),
            $results
        );
    }

    public function testCity(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->cities); $i++) {
            $results[] = $this->faker->unique()->city();
        }

        $this->assertEqualsCanonicalizing(
            array_keys($this->cities),
            $results
        );
    }

    public function testCitiesBelongToAState(): void
    {
        foreach ($this->cities as $stateCode) {
            $this->assertContains($stateCode, $this->states);
            $this->assertArrayHasKey($stateCode, $this->postcodeRanges);
        }
    }

    public function testPostcode(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $postcode = $this->faker->postcode();

            $this->assertMatchesRegularExpression('/^\d{4}$/', $postcode);
            $this->assertTrue($this->postcodeMatchesAState((int) $postcode), "Postcode {$postcode} is outside every state range.");
        }
    }

    public function testHouseNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $houseNumber = $this->faker->houseNumber();

            $this->assertGreaterThanOrEqual(1, $houseNumber);
            $this->assertLessThanOrEqual(300, $houseNumber);
        }
    }

    public function testStreetName(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $streetName = $this->faker->streetName();
            $separator = strrpos($streetName, ' ');

            $this->assertContains(substr($streetName, 0, $separator), $this->streetNames);
            $this->assertContains(substr($streetName, $separator + 1), $this->streetTypes);
        }
    }

    public function testStreetAddress(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $streetAddress = $this->faker->streetAddress();

            $this->assertMatchesRegularExpression('/^\d{1,3} [A-Za-z ]+$/', $streetAddress);
        }
    }

    public function testFullAddress(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $fullAddress = $this->faker->fullAddress();

            $this->assertMatchesRegularExpression('/^\d{1,3} [A-Za-z ]+, ([A-Za-z ]+) ([A-Z]{2,3}) (\d{4})$/', $fullAddress);

            preg_match('/, ([A-Za-z ]+) ([A-Z]{2,3}) (\d{4})$/', $fullAddress, $matches);
            [, $city, $stateCode, $postcode] = $matches;
            [$min, $max] = $this->postcodeRanges[$stateCode];

            $this->assertSame($this->cities[$city], $stateCode);
            $this->assertGreaterThanOrEqual($min, (int) $postcode);
            $this->assertLessThanOrEqual($max, (int) $postcode);
        }
    }

    private function postcodeMatchesAState(int $postcode): bool
    {
        foreach ($this->postcodeRanges as [$min, $max]) {
            if ($postcode >= $min && $postcode <= $max) {
                return true;
            }
        }

        return false;
    }
}
