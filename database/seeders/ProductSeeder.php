<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();
        $faker = Factory::create('id_ID');
        $categories = Category::get();
        //$image = "images";
        for ($i = 0; $i < 100; $i++) {
        Product::create([
            "category_id" => $categories->random()->id,
            "title" => 'palugada',
            "status" => 'active',
            "description" => 'palugada',
            "image" => 'images/product/ATmfYfUuxFHxNaCaKfRLN4X2LrVPri1zxxN3ezgn.png',
            "weight" => 10,
            "price" => 10,
        ]);
    }
    }
}