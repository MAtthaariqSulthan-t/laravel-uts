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
        $faker = Factory::create('id_ID');
        $categories = Category::get();
        //$image = "images";
        Product::create([
            "category_id" => $categories->random()->id,
            "title" => $categories,
            "status" => $categories,
            "description" => $categories,
            "image" => $categories,
            "weight" => $categories,
            "price" => $categories,
        ]);
    }
}
