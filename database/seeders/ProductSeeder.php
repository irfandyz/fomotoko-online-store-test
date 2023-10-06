<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
            'name'=>'Laptop Asus',
            'stock'=>100,
            'price'=>10000000,
            ],
            [
            'name'=>'Laptop Acer',
            'stock'=>50,
            'price'=>6000000,
            ],
            [
            'name'=>'Laptop Lenovo',
            'stock'=>50,
            'price'=>2000000,
            ],
            [
            'name'=>'Laptop Advan',
            'stock'=>1,
            'price'=>2000000,
            ],
        ];

        foreach ($data as $value) {
            Product::create($value);
        }
    }
}
