<?php

namespace Xefi\Faker\EnAu\Extensions;

use Xefi\Faker\Extensions\PhoneExtension as BasePhoneExtension;

class PhoneExtension extends BasePhoneExtension
{
    public string $defaultPrefix = '0';

    public string $indicator = '+61';

    protected array $landlineFormats = [
        '2{separator}{d}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '3{separator}{d}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '7{separator}{d}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '8{separator}{d}{d}{d}{d}{separator}{d}{d}{d}{d}',
    ];

    protected array $cellFormats = [
        '4{d}{d}{separator}{d}{d}{d}{separator}{d}{d}{d}',
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
     * Generate a phone number, dropping the trunk prefix "0" in favour of the separated "+61" indicator.
     *
     * @param string|null $format
     * @param string      $separator
     * @param string|null $prefix
     *
     * @return string
     */
    public function phoneNumber(?string $format = null, string $separator = '', ?string $prefix = null): string
    {
        if ($format === null) {
            $format = $this->pickArrayRandomElement(array_merge($this->landlineFormats, $this->cellFormats));
        }

        if ($prefix === $this->indicator) {
            $prefix .= $separator;
        }

        return parent::phoneNumber($format, $separator, $prefix);
    }
}
