<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Question;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    return [
    	//creating a sentence with 5 - 10 words without "."
        'title' => rtrim($faker->sentence(rand(5, 10)), '.'),
        //creating paragraphs with 3 - 7 sentences. setting true will return as a string rather than as an array as default
        'body' => $faker->paragraphs(rand(3, 7), true),
        'views' => rand(0, 10),
       // 'answers' => rand(0, 10), //automatically generated at answers model at boot method
        'votes' => rand(-3, 10) //with negative values
    ];
});
