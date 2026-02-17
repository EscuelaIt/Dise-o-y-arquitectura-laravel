<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product['name'] }}</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .price { font-size: 1.5em; font-weight: bold; color: #28a745; }
        .breakdown { background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 20px 0; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>{{ $product['name'] }}</h1>
    <p>{{ $product['description'] }}</p>

    <div class="price">
        Precio final: &euro;{{ $product['final_price'] }}
    </div>

    <div class="breakdown">
        <h3>Desglose de precios:</h3>
        <ul>
            <li>Precio base: &euro;{{ $product['formatted_base_price'] }}</li>
            <li>Descuento ({{ $product['discount_rate'] * 100 }}%): &euro;{{ $product['price_after_discount'] }}</li>
            <li>Impuesto ({{ $product['tax_rate'] * 100 }}%): &euro;{{ $product['tax_amount'] }}</li>
        </ul>
    </div>

    <a href="{{ route('products.show', 1) }}">Volver al producto</a>
</body>
</html>
