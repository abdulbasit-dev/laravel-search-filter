<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Faker\Factory;
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
        $faker = Factory::create();
        for ($i = 0; $i < 10000; $i++) {
            $product = Product::create([
                'name' => $faker->name(),
                'description' => $faker->paragraph(),
                'price' => $faker->randomFloat(2, 100, 5000),
                'image' => "https://via.placeholder.com/150/?Text=Digital.com", // password
                'category_id' => Category::inRandomOrder()->first()->id
            ]);

            $tags = Tag::inRandomOrder()->take(rand(2, 4))->pluck('id')->toArray();
            $product->tags()->attach($tags);
        }
    }
}
