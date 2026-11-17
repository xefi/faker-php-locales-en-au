<?php

namespace Xefi\Faker\EnAu\Extensions;

use Xefi\Faker\Extensions\Extension;

class CompanyExtension extends Extension
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

    private array $companies = [
        'Southern Cross Logistics Pty Ltd', 'Coastline Building Group Pty Ltd', 'Red Gum Timber Co. Pty Ltd',
        'Harbourside Financial Services Ltd', 'Outback Freight Pty Ltd', 'Wattle Creek Wines Pty Ltd',
        'Barrier Reef Marine Pty Ltd', 'Murray River Produce Pty Ltd', 'Bluegum Health Pty Ltd',
        'Kookaburra Software Pty Ltd', 'Pacific Rim Mining Ltd', 'Golden Wattle Insurance Ltd',
        'Ironbark Engineering Pty Ltd', 'Sunburnt Country Tours Pty Ltd', 'Brindabella Consulting Pty Ltd',
        'Flinders Ranges Pastoral Co. Pty Ltd', 'Bondi Surf Supplies Pty Ltd', 'Great Dividing Energy Ltd',
        'Kimberley Resources Ltd', 'Nullarbor Transport Pty Ltd', 'Saltwater Creative Pty Ltd',
        'Yarra Valley Dairy Pty Ltd', 'Top End Electrical Pty Ltd', 'Gondwana Labs Pty Ltd',
        'Swan River Property Group Ltd', 'Tasman Aquaculture Pty Ltd', 'Hunter Valley Cellars Pty Ltd',
        'Blue Mountains Retreats Pty Ltd', 'Sandstone Legal Pty Ltd', 'Coral Coast Retail Pty Ltd',
    ];

    /**
     * Return a random company name.
     *
     * @return string
     */
    public function company(): string
    {
        return $this->pickArrayRandomElement($this->companies);
    }

    /**
     * Generate an Australian Company Number (ACN) with a valid modulus 10 check digit.
     *
     * @return string
     */
    public function companyNumber(): string
    {
        $digits = array_map('intval', str_split($this->randomizer->getBytesFromString('0123456789', 8)));

        $sum = 0;
        foreach ($digits as $index => $digit) {
            $sum += $digit * (8 - $index);
        }

        return implode('', $digits).((10 - $sum % 10) % 10);
    }

    /**
     * Generate an Australian Business Number (ABN) with valid modulus 89 check digits.
     *
     * @param bool $formatted Whether to group the digits as "NN NNN NNN NNN".
     *
     * @return string
     */
    public function abn(bool $formatted = false): string
    {
        $weights = [3, 5, 7, 9, 11, 13, 15, 17, 19];
        $body = array_map('intval', str_split($this->randomizer->getBytesFromString('0123456789', 9)));

        $sum = 0;
        foreach ($weights as $index => $weight) {
            $sum += $body[$index] * $weight;
        }

        $abn = ((89 - $sum % 89) % 89 + 10).implode('', $body);

        return $formatted
            ? sprintf('%s %s %s %s', substr($abn, 0, 2), substr($abn, 2, 3), substr($abn, 5, 3), substr($abn, 8, 3))
            : $abn;
    }
}
