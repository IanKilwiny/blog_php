<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('posts', [PostController::class, 'index']);

Route::resource('/', PostController::class) ->names([
    'index' => 'posts.index',
    'create' =>'posts.create',
    'store' => 'posts.store',
    'show' => 'posts.show',
]);

Route::any('/remove/{id}', [PostController::class, 'destroy']);


