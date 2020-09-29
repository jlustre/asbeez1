<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => ucwords(rtrim($faker->text(20), '.')),
        // 'description' => $faker->sentence(5),
        'created_at' => now(),
        'updated_at' => now()
    ];
});
