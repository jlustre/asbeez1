<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\Category;;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => ucwords(rtrim($faker->sentence(4), '.')),
        'price' => $faker->randomDigitNot(0) * 100,
        // 'description'  => $faker->text,
        'category_id'   => Category::pluck('id')->random(),
        'created_at' => now(),
        'updated_at' => now()
    ];
});
