<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::resource('register', Register::class);
// Route::resource('auth', Auth::class);

Route::group(["middleware"=> "api"],function($routes){
    Route::post('/register',[UserController::class, 'Register']);
    Route::post('/login',[UserController::class, 'Login']);
    Route::get('/refresh',[UserController::class, 'Refresh']);
});

Route::post("sup-category/create",[CategoryController::class, 'CreateSuperCategory']);
Route::post("sub-category/create",[CategoryController::class, 'CreateSubCategory']);
Route::post("create",[CategoryController::class, 'CreateItem']);
Route::get("sub-category/{id}",[CategoryController::class, 'FetchById']);
Route::get("products",[CategoryController::class, 'GetProducts']);