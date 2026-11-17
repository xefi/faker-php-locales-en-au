<?php

namespace Xefi\Faker\EnAu\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\Extensions\PersonExtension;

final class PersonExtensionTest extends TestCase
{
    protected array $firstNameMale = [];
    protected array $firstNameFemale = [];
    protected array $lastName = [];
    protected array $titleMale = [];
    protected array $titleFemale = [];

    protected function setUp(): void
    {
        parent::setUp();

        $personExtension = new \Xefi\Faker\EnAu\Extensions\PersonExtension(new Randomizer());
        $reflection = new ReflectionClass($personExtension);

        $this->firstNameMale = $reflection->getProperty('firstNameMale')->getValue($personExtension);
        $this->firstNameFemale = $reflection->getProperty('firstNameFemale')->getValue($personExtension);
        $this->lastName = $reflection->getProperty('lastName')->getValue($personExtension);
        $this->titleMale = $reflection->getProperty('titleMale')->getValue($personExtension);
        $this->titleFemale = $reflection->getProperty('titleFemale')->getValue($personExtension);
    }

    public function testFirstNameFemale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->firstNameFemale); $i++) {
            $results[] = $this->faker->unique()->firstName(PersonExtension::GENDER_FEMALE);
        }

        $this->assertEqualsCanonicalizing(
            $this->firstNameFemale,
            $results
        );
    }

    public function testFirstNameMale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->firstNameMale); $i++) {
            $results[] = $this->faker->unique()->firstName(PersonExtension::GENDER_MALE);
        }

        $this->assertEqualsCanonicalizing(
            $this->firstNameMale,
            $results
        );
    }

    public function testFirstName(): void
    {
        $results = [];
        $firstNames = array_unique(array_merge($this->firstNameMale, $this->firstNameFemale));
        for ($i = 0; $i < count($firstNames); $i++) {
            $results[] = $this->faker->unique()->firstName();
        }

        $this->assertEqualsCanonicalizing(
            $firstNames,
            $results
        );
    }

    public function testLastName(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->lastName); $i++) {
            $results[] = $this->faker->unique()->lastName();
        }

        $this->assertEqualsCanonicalizing(
            $this->lastName,
            $results
        );
    }

    public function testName(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $gender = $this->faker->randomElement([null, PersonExtension::GENDER_MALE, PersonExtension::GENDER_FEMALE]);
            $firstNames = match ($gender) {
                PersonExtension::GENDER_MALE => $this->firstNameMale,
                PersonExtension::GENDER_FEMALE => $this->firstNameFemale,
                default => array_merge($this->firstNameMale, $this->firstNameFemale),
            };

            [$firstName, $lastName] = explode(' ', $this->faker->name($gender), 2);

            $this->assertContains($firstName, $firstNames);
            $this->assertContains($lastName, $this->lastName);
        }
    }

    public function testTitle(): void
    {
        $titles = array_unique(array_merge($this->titleFemale, $this->titleMale));

        $results = [];
        for ($i = 0; $i < count($titles); $i++) {
            $results[] = $this->faker->unique()->title();
        }

        $this->assertEqualsCanonicalizing(
            $titles,
            $results
        );
    }

    public function testTitleByGender(): void
    {
        for ($i = 0; $i < 50; $i++) {
            $this->assertContains($this->faker->title(PersonExtension::GENDER_MALE), $this->titleMale);
            $this->assertContains($this->faker->title(PersonExtension::GENDER_FEMALE), $this->titleFemale);
        }
    }

    public function testTfn(): void
    {
        $weights = [1, 4, 3, 7, 5, 8, 6, 9, 10];

        for ($i = 0; $i < 100; $i++) {
            $tfn = $this->faker->tfn();

            $this->assertMatchesRegularExpression('/^[1-9]\d{8}$/', $tfn);

            $sum = 0;
            foreach (str_split($tfn) as $index => $digit) {
                $sum += (int) $digit * $weights[$index];
            }
            $this->assertSame(0, $sum % 11, "TFN {$tfn} has an invalid check digit.");
        }
    }

    public function testFormattedTfn(): void
    {
        $this->assertMatchesRegularExpression('/^\d{3} \d{3} \d{3}$/', $this->faker->tfn(true));
    }

    public function testMedicareNumber(): void
    {
        $weights = [1, 3, 7, 9, 1, 3, 7, 9];

        for ($i = 0; $i < 100; $i++) {
            $number = $this->faker->medicareNumber();

            $this->assertMatchesRegularExpression('/^[2-6]\d{8}[1-9]$/', $number);

            $sum = 0;
            foreach ($weights as $index => $weight) {
                $sum += (int) $number[$index] * $weight;
            }
            $this->assertSame($sum % 10, (int) $number[8], "Medicare number {$number} has an invalid check digit.");
        }
    }

    public function testFormattedMedicareNumber(): void
    {
        $this->assertMatchesRegularExpression('/^[2-6]\d{3} \d{5} [1-9]$/', $this->faker->medicareNumber(true));
    }
}
