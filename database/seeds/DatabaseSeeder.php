<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 20)->create()->each(function($u) {
    	    $u->questions()->saveMany(factory(App\Question::class, rand(1, 5))->make())
            ->each(function($q) {
               $q->answers()->saveMany(factory(App\Answer::class, rand(1, 5))->make());
            });
        });
        //see CategoryFactory
        factory(Category::class,20)->create();
        //see ProductFactory
        factory(Product::class,5)->create();
    }
}
