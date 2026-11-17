<?php

namespace Xefi\Faker\EnAu;

use Xefi\Faker\EnAu\Extensions\AddressExtension;
use Xefi\Faker\EnAu\Extensions\ColorsExtension;
use Xefi\Faker\EnAu\Extensions\CompanyExtension;
use Xefi\Faker\EnAu\Extensions\FinancialExtension;
use Xefi\Faker\EnAu\Extensions\PersonExtension;
use Xefi\Faker\EnAu\Extensions\PhoneExtension;
use Xefi\Faker\EnAu\Extensions\TextExtension;
use Xefi\Faker\Providers\Provider;

class FakerEnAuServiceProvider extends Provider
{
    public function boot(): void
    {
        $this->extensions([
            AddressExtension::class,
            ColorsExtension::class,
            CompanyExtension::class,
            FinancialExtension::class,
            PersonExtension::class,
            PhoneExtension::class,
            TextExtension::class,
        ]);
    }
}
