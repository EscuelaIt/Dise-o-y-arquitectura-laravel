<?php

namespace App\Http\Controllers;

use App\Services\PriceCalculator;

class ProductController extends Controller
{

    public function show(string $id)
    {
        $products = [
            '1' => [
                'id' => '1',
                'name' => 'HP Active 2 HDI',
                'description' => 'Un ordenador portatil de alta gama preparado para trabajo en el hogar o en la oficina.',
                'base_price' => 1200.00,
                'tax_rate' => 0.21,
                'discount_rate' => 0.5
            ]
        ];

        if (!isset($products[$id])) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $product = $products[$id];

        //$priceCalculator = new PriceCalculator($product['tax_rate'], $product['discount_rate']);
        $priceCalculator = new PriceCalculator('en');
        $priceCalculator->setTaxRate($product['tax_rate'])->setDiscountRate($product['discount_rate']);
        $price = $priceCalculator->calculate($product['base_price']);

        $product['final_price'] = $price['finalPrice'];
        $product['price_after_discount'] = $price['priceWithDiscount'];
        $product['tax_amount'] = $price['taxAmount'];
        $product['formatted_base_price'] = $price['formatted_base_price'];

        return view('products.show')->with([
            'product' => $product,
        ]);
    }
}
