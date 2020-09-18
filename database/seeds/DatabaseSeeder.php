<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 5)->create()->each(function($u) {
    	    $u->questions()->saveMany(factory(App\Question::class, rand(1, 5))->make())
            ->each(function($q) {
               $q->answers()->saveMany(factory(App\Answer::class, rand(1, 5))->make());
            });
        });
        Model::unguard();
        // DB::table('categories')->truncate(); //If you want to reset to 50. See note below.
        $this->call('CategoriesSeeder');
    }
}
