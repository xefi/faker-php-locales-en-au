<?php

namespace Xefi\Faker\EnAu\Extensions;

use Xefi\Faker\Extensions\PersonExtension as BasePersonExtension;

class PersonExtension extends BasePersonExtension
{
    /**
     * The extension locale.
     *
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return 'en_AU';
    }

    protected $firstNameMale = [
        'Jack', 'Oliver', 'William', 'Noah', 'Thomas', 'James', 'Lachlan', 'Cooper', 'Riley', 'Mitchell',
        'Liam', 'Ethan', 'Lucas', 'Henry', 'Charlie', 'Harrison', 'Hamish', 'Angus', 'Bailey', 'Jayden',
        'Joshua', 'Benjamin', 'Samuel', 'Daniel', 'Matthew', 'Nathan', 'Ryan', 'Bradley', 'Brodie', 'Darcy',
        'Hudson', 'Xavier', 'Archie', 'Max', 'Leo', 'Isaac', 'Callum', 'Tyson', 'Flynn', 'Patrick',
    ];

    protected $firstNameFemale = [
        'Charlotte', 'Olivia', 'Amelia', 'Isla', 'Mia', 'Ava', 'Grace', 'Chloe', 'Matilda', 'Ella',
        'Sophie', 'Emily', 'Zoe', 'Ruby', 'Harper', 'Willow', 'Evie', 'Sienna', 'Isabella', 'Lily',
        'Georgia', 'Jessica', 'Hannah', 'Madison', 'Kayla', 'Brooke', 'Tahlia', 'Jasmine', 'Kirra', 'Indi',
        'Mackenzie', 'Lauren', 'Kate', 'Emma', 'Holly', 'Imogen', 'Scarlett', 'Poppy', 'Alice', 'Hayley',
    ];

    protected $lastName = [
        'Smith', 'Jones', 'Williams', 'Brown', 'Wilson', 'Taylor', 'Johnson', 'White', 'Martin', 'Anderson',
        'Thompson', 'Nguyen', 'Thomas', 'Walker', 'Harris', 'Lee', 'Ryan', 'Robinson', 'Kelly', 'King',
        'Davis', 'Wright', 'Evans', 'Roberts', 'Green', 'Hall', 'Wood', 'Jackson', 'Clarke', 'Patel',
        'Khan', 'Lewis', 'James', 'Phillips', 'Mitchell', 'Turner', 'O\'Brien', 'Murphy', 'Campbell', 'Kennedy',
    ];

    protected $titleMale = ['Mr', 'Dr', 'Prof', 'Rev', 'Sir'];

    protected $titleFemale = ['Ms', 'Mrs', 'Miss', 'Dr', 'Prof', 'Rev', 'Dame'];

    /**
     * Generate a Tax File Number (TFN) with a valid modulus 11 check digit.
     *
     * @param bool $formatted Whether to group the digits as "NNN NNN NNN".
     *
     * @return string
     */
    public function tfn(bool $formatted = false): string
    {
        $weights = [1, 4, 3, 7, 5, 8, 6, 9];

        do {
            $digits = array_map('intval', str_split($this->randomizer->getBytesFromString('0123456789', 8)));
            $digits[0] = $this->randomizer->getInt(1, 9);

            $sum = 0;
            foreach ($weights as $index => $weight) {
                $sum += $digits[$index] * $weight;
            }
        } while ($sum % 11 === 10);

        $tfn = implode('', $digits).($sum % 11);

        return $formatted ? implode(' ', str_split($tfn, 3)) : $tfn;
    }

    /**
     * Generate a Medicare card number with a valid check digit and an issue number.
     *
     * @param bool $formatted Whether to group the digits as "NNNN NNNNN N".
     *
     * @return string
     */
    public function medicareNumber(bool $formatted = false): string
    {
        $weights = [1, 3, 7, 9, 1, 3, 7, 9];

        $digits = array_map('intval', str_split($this->randomizer->getBytesFromString('0123456789', 8)));
        $digits[0] = $this->randomizer->getInt(2, 6);

        $sum = 0;
        foreach ($weights as $index => $weight) {
            $sum += $digits[$index] * $weight;
        }

        $number = implode('', $digits).($sum % 10).$this->randomizer->getInt(1, 9);

        return $formatted
            ? sprintf('%s %s %s', substr($number, 0, 4), substr($number, 4, 5), substr($number, 9, 1))
            : $number;
    }
}
