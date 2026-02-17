<?php

namespace App\Services;

class PriceCalculator
{
    public function __construct(
        private float $taxRate = 0.21,
        private float $discountRate = 0.0
    ) {}

    public function setTaxRate(float $taxRate): self
    {
        $this->taxRate = $taxRate;
        return $this;
    }

    public function setDiscountRate(float $discountRate): self
    {
        $this->discountRate = $discountRate;
        return $this;
    }

    public function calculate(float $basePrice): array
    {
        $priceWithDiscount = $basePrice - ($basePrice * $this->discountRate);
        $priceWithTax = $priceWithDiscount + ($priceWithDiscount * $this->taxRate);
        $finalPrice = round($priceWithTax, 2);

        return [
            'priceWithDiscount' => $priceWithDiscount,
            'priceWithTax' => $priceWithTax,
            'finalPrice' => $finalPrice,
            'taxAmount' => $priceWithTax - $priceWithDiscount,
        ];
    }
}
