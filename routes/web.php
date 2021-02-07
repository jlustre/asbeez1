<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Resources\ProductResource;
// use App\Http\Resources\CategoryResource;
// use App\Category;
// use App\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::middleware('verified')->group(function () {
    // Put protected routes here
});
   
Route::resource('questions', 'QuestionsController')->except('show');
Route::get('questions/{slug}', 'QuestionsController@show')->name('questions.show');

Route::resource('questions.answers', 'AnswersController')->only(['store','edit','update', 'destroy']);
Route::post('answers/{answer}/accept', 'AcceptAnswerController')->name('answers.accept');

Route::post('questions/{question}/favorites', 'FavoritesController@store')->name('questions.favorite');
Route::delete('questions/{question}/favorites', 'FavoritesController@destroy')->name('questions.unfavorite');

Route::post('/questions/{question}/vote', 'VoteQuestionController'); 

// Route::post('/questions/{question}/answers', 'AnswersController@store')->name('answers.store')


// Route::get('/products', function() {
//     $products = Product::orderBy('name')->get();
//     return ProductResource::collection($products);
// });

//Using model binding
// Route::get('/products/{product}', function(Product $product) {
//     return new ProductResource($product);
// });

// Route::get('/products/{id}', function($id) {
    // $product = Product::findOrFail($id);
    // return new ProductResource($product);
// });

// Route::get('/categories', function() {
//     $categories = Category::orderBy('name')->get();
//     return CategoryResource::collection($categories);
// });

// Route::get('/categories/{category}', function(Category $category) {
//     return new CategoryResource($category);
// });

