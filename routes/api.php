<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\auth\EditProfileController;
use App\Http\Controllers\auth\RestPasswordController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\CategoryController;
// use App\Http\Controllers\ArticleController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::controller(EditProfileController::class)->group(function(){
      Route::get('showprofile','showprofile')->middleware(['permission:view profile']);
      Route::put('update','update')->middleware(['permission:edit profile']);
});

Route::post('forgot-password', [RestPasswordController::class, 'forgetPassword'])->name('password.request');
Route::post('/reset-password/{token}', [RestPasswordController::class, 'resetPassword'])->name('password.reset');

Route::controller(ProductController::class)->group(function(){
          Route::post('storeproduct', 'storeProduct')->middleware(['permission:add product']);
          Route::get('showproduct/{id}', 'showproduct');
          Route::post('updateproduct/{id}', 'updateProduct');
          Route::delete('deleteproduct/{id}', 'deleteProdcut');
});

Route::controller(CategoryController::class)->group(function(){
    Route::post('storecategory', 'storeCategory');
    Route::get('showcategory/{id}', 'showCategory');
    Route::put('updatecategory/{id}', 'updateCategory');
    Route::delete('deletecategory/{id}', 'deleteCategory');
});
