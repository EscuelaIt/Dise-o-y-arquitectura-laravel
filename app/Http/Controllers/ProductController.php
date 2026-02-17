<?php

namespace App\Http\Controllers;

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
                'discount_rate' => 0.15
            ]
        ];

        if (!isset($products[$id])) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $product = $products[$id];


        $priceWithDiscount = $product['base_price'] - ($product['base_price'] * $product['discount_rate']);
        $priceWithTax = $priceWithDiscount + ($priceWithDiscount * $product['tax_rate']);
        $finalPrice = round($priceWithTax, 2);

        // Add calculated price to product
        $product['final_price'] = $finalPrice;
        $product['price_after_discount'] = round($priceWithDiscount, 2);
        $product['tax_amount'] = round($priceWithTax - $priceWithDiscount, 2);

        return view('products.show')->with([
            'product' => $product,
        ]);
    }
}
