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
        /* temporarily comment this
        
        //see CategoryFactory
        factory(Category::class,20)->create();
        //see ProductFactory
        factory(Product::class,5)->create();
        */

        $this->call([
            UsersQuestionsAnswersTableSeeder::class,
            FavoritesTableSeeder::class,
        ]);
    }
}
