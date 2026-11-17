<?php

namespace Xefi\Faker\EnAu\Extensions;

use Xefi\Faker\Extensions\FinancialExtension as BaseFinancialExtension;

class FinancialExtension extends BaseFinancialExtension
{
    protected array $bsbBankCodes = ['01', '03', '06', '08', '18', '30', '48', '63', '73'];

    protected array $bsbStateCodes = ['2', '3', '4', '5', '6', '7'];

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
     * Generate a Bank State Branch (BSB) code.
     *
     * @param bool $formatted Whether to separate the bank/state part from the branch with a dash.
     *
     * @return string
     */
    public function bsb(bool $formatted = true): string
    {
        $bank = $this->pickArrayRandomElement($this->bsbBankCodes).$this->pickArrayRandomElement($this->bsbStateCodes);
        $branch = $this->randomizer->getBytesFromString('0123456789', 3);

        return $formatted ? $bank.'-'.$branch : $bank.$branch;
    }

    /**
     * Australia does not use IBAN: this builds an IBAN-shaped string from a BSB and a 9-digit account number.
     *
     * @param string|null $countryCode
     * @param string|null $format      [{d} => digit, {l} => letter, {a} => any]
     *
     * @return string
     */
    public function iban(?string $countryCode = null, ?string $format = null): string
    {
        if ($countryCode === null) {
            $countryCode = 'AU';
        }

        if ($format === null) {
            $format = $this->bsb(false).str_repeat('{d}', 9);
        }

        return parent::iban($countryCode, $format);
    }
}
