<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1, 20) as $index) {
            Category::create([
                'name' => ucwords(rtrim($faker->sentence(2), '.')),
                'description'  => $faker->text,
                // 'content'   => $faker->paragraph(4)
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}

