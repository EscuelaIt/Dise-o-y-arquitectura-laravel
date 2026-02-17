<?php

namespace App\Services;

class PriceCalculator
{
    private string $language = 'en';

    public function __construct(
        string $language = 'en',
        private float $taxRate = 0.21,
        private float $discountRate = 0.0
    ) {
        $this->setLanguage($language);
    }

    public function setLanguage(string $language): self
    {
        $this->language = in_array($language, ['es', 'en']) ? $language : 'en';
        return $this;
    }

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

    private function formatPrice(float $price): string
    {
        if ($this->language === 'es') {
            return number_format($price, 2, ',', '.');
        }

        return number_format($price, 2, '.', ',');
    }

    public function calculate(float $basePrice): array
    {
        $priceWithDiscount = $basePrice - ($basePrice * $this->discountRate);
        $priceWithTax = $priceWithDiscount + ($priceWithDiscount * $this->taxRate);
        $finalPrice = round($priceWithTax, 2);

        return [
            'formatted_base_price' => $this->formatPrice($basePrice),
            'priceWithDiscount' => $this->formatPrice($priceWithDiscount),
            'priceWithTax' => $this->formatPrice($priceWithTax),
            'finalPrice' => $this->formatPrice($finalPrice),
            'taxAmount' => $this->formatPrice($priceWithTax - $priceWithDiscount),
        ];
    }
}
