<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Product;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1, 50) as $index) {
            Product::create([
                // 'name' => "Product $index",
                'name' => ucwords(rtrim($faker->sentence(4), '.')),
                'price' => $faker->randomDigitNot(0) * 100,
                'description'  => $faker->text,
                'category_id'   => $faker->numberBetween(1, 20),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
