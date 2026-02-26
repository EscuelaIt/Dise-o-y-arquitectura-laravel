<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::create([
            'name' => 'Básico',
            'description' => 'Acceso limitado a funcionalidades básicas',
            'price' => 9.99,
        ]);

        Plan::create([
            'name' => 'Profesional',
            'description' => 'Acceso completo a todas las funcionalidades',
            'price' => 19.99,
        ]);

        Plan::create([
            'name' => 'Empresarial',
            'description' => 'Acceso VIP con soporte prioritario',
            'price' => 49.99,
        ]);
    }
}
