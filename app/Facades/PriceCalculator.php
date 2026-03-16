<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class PriceCalculator extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'price-calculator';
    }
}
