<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $names = ['Básico', 'Profesional', 'Empresarial'];
        static $count = 0;

        $planNames = ['Básico', 'Profesional', 'Empresarial'];
        $prices = [9.99, 19.99, 49.99];
        $descriptions = [
            'Acceso limitado a funcionalidades básicas',
            'Acceso completo a todas las funcionalidades',
            'Acceso VIP con soporte prioritario'
        ];

        $name = $planNames[$count % 3];
        $price = $prices[$count % 3];
        $description = $descriptions[$count % 3];
        $count++;

        return [
            'name' => $name,
            'description' => $description,
            'price' => $price,
        ];
    }
}
