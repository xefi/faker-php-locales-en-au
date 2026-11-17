<?php

namespace Xefi\Faker\EnAu\Extensions;

use Xefi\Faker\Extensions\Extension;

class AddressExtension extends Extension
{
    protected $states = [
        'New South Wales' => 'NSW', 'Victoria' => 'VIC', 'Queensland' => 'QLD', 'South Australia' => 'SA',
        'Western Australia' => 'WA', 'Tasmania' => 'TAS', 'Northern Territory' => 'NT',
        'Australian Capital Territory' => 'ACT',
    ];

    protected $postcodeRanges = [
        'NSW' => [2000, 2599], 'VIC' => [3000, 3999], 'QLD' => [4000, 4999], 'SA' => [5000, 5799],
        'WA' => [6000, 6797], 'TAS' => [7000, 7799], 'NT' => [800, 899], 'ACT' => [2600, 2618],
    ];

    protected $cities = [
        'Sydney' => 'NSW', 'Newcastle' => 'NSW', 'Wollongong' => 'NSW', 'Wagga Wagga' => 'NSW', 'Albury' => 'NSW',
        'Dubbo' => 'NSW', 'Tamworth' => 'NSW', 'Port Macquarie' => 'NSW', 'Melbourne' => 'VIC', 'Geelong' => 'VIC',
        'Ballarat' => 'VIC', 'Bendigo' => 'VIC', 'Shepparton' => 'VIC', 'Brisbane' => 'QLD', 'Gold Coast' => 'QLD',
        'Townsville' => 'QLD', 'Cairns' => 'QLD', 'Toowoomba' => 'QLD', 'Mackay' => 'QLD', 'Rockhampton' => 'QLD',
        'Adelaide' => 'SA', 'Mount Gambier' => 'SA', 'Whyalla' => 'SA', 'Perth' => 'WA', 'Fremantle' => 'WA',
        'Bunbury' => 'WA', 'Geraldton' => 'WA', 'Kalgoorlie' => 'WA', 'Hobart' => 'TAS', 'Launceston' => 'TAS',
        'Devonport' => 'TAS', 'Darwin' => 'NT', 'Alice Springs' => 'NT', 'Canberra' => 'ACT',
    ];

    protected $streetTypes = [
        'Street', 'Road', 'Avenue', 'Parade', 'Crescent', 'Drive', 'Place', 'Terrace', 'Lane', 'Close',
        'Court', 'Esplanade', 'Way', 'Grove', 'Highway', 'Boulevard',
    ];

    protected $streetNames = [
        'George', 'Pitt', 'Collins', 'Flinders', 'Bourke', 'Elizabeth', 'Swanston', 'Macquarie', 'Hunter',
        'King William', 'Murray', 'Hay', 'Ann', 'Adelaide', 'Wickham', 'Brunswick', 'Chapel', 'Oxford', 'Crown',
        'Lonsdale', 'Spencer', 'Russell', 'Rundle', 'Grenfell', 'Lygon', 'Darling', 'Stirling', 'Hindley',
        'Sturt', 'Bligh', 'Phillip', 'Lachlan', 'Wattle', 'Banksia', 'Jacaranda', 'Waratah', 'Kurrajong', 'Boronia',
    ];

    /**
     * The extension locale.
     *
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return 'en_AU';
    }

    /**
     * Return a random state or territory name.
     *
     * @return string
     */
    public function state(): string
    {
        return $this->pickArrayRandomKey($this->states);
    }

    /**
     * Return a random state or territory abbreviation.
     *
     * @return string
     */
    public function stateCode(): string
    {
        return $this->pickArrayRandomElement($this->states);
    }

    /**
     * Return a random city.
     *
     * @return string
     */
    public function city(): string
    {
        return $this->pickArrayRandomKey($this->cities);
    }

    /**
     * Return a random 4-digit postcode, within the range of a random state or territory.
     *
     * @return string
     */
    public function postcode(): string
    {
        return $this->postcodeForState($this->pickArrayRandomKey($this->postcodeRanges));
    }

    /**
     * Return a random house number.
     *
     * @return int
     */
    public function houseNumber(): int
    {
        return $this->randomizer->getInt(1, 300);
    }

    /**
     * Return a random street name followed by its street type.
     *
     * @return string
     */
    public function streetName(): string
    {
        return sprintf(
            '%s %s',
            $this->pickArrayRandomElement($this->streetNames),
            $this->pickArrayRandomElement($this->streetTypes)
        );
    }

    /**
     * Return a random street address.
     *
     * @return string
     */
    public function streetAddress(): string
    {
        return sprintf('%d %s', $this->houseNumber(), $this->streetName());
    }

    /**
     * Return a full address on one line: street address, city, state abbreviation and postcode.
     *
     * @return string
     */
    public function fullAddress(): string
    {
        $city = $this->city();
        $stateCode = $this->cities[$city];

        return sprintf('%s, %s %s %s', $this->streetAddress(), $city, $stateCode, $this->postcodeForState($stateCode));
    }

    /**
     * Return a random postcode within the range of the given state or territory.
     *
     * @param string $stateCode
     *
     * @return string
     */
    protected function postcodeForState(string $stateCode): string
    {
        [$min, $max] = $this->postcodeRanges[$stateCode];

        return sprintf('%04d', $this->randomizer->getInt($min, $max));
    }
}
