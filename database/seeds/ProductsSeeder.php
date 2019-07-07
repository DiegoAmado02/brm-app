<?php

use Illuminate\Database\Seeder;
use \App\Models\Products;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Products::create([
            'product' => 'Leche',
            'lote' => 'LL01',
            'quantity' => 5,
            'expiration_date' => '2019-08-25',
            'price' => '2500',
            'is_active' => true
        ]);

        Products::create([
            'product' => 'Yogurt',
            'lote' => 'LY01',
            'quantity' => 12,
            'expiration_date' => '2019-12-25',
            'price' => '2200',
            'is_active' => true
        ]);
    }
}
