<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Answer;
use Faker\Generator as Faker;

$factory->define(Answer::class, function (Faker $faker) {
    return [
        //creating paragraphs with 3 - 7 sentences. setting true will return as a string rather than as an array as default
        'body' => $faker->paragraphs(rand(3, 7), true), 
        //this will get random id from user table
        'user_id' => App\User::pluck('id')->random(),
        'votes_count' => rand(0, 10),
    ];
});
