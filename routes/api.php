<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\auth\EditProfileController;
use App\Http\Controllers\auth\RestPasswordController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\role\RoleController;
use App\Http\Controllers\api\SearchController;
use App\Http\Controllers\role\RolePermissionController;


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
    Route::get('showprofile','showprofile')->middleware(['permission:view profile|view all profile']);
    Route::put('update','update')->middleware(['permission:edit profile|edit all profile']);
});
Route::controller(RolePermissionController::class)->group(function(){
    Route::put('changerole/{user}','changeRole')->middleware(['permission:change role user']);
    Route::delete('deleterole/{user}','removeRole')->middleware(['permission:change role user']);
    Route::delete('changerolepermission/{user}','changePermissionToRole')->middleware(['permission:change role to permission']);
});

Route::post('forgot-password', [RestPasswordController::class, 'forgetPassword'])->name('password.request');
Route::post('/reset-password/{token}', [RestPasswordController::class, 'resetPassword'])->name('password.reset');

Route::controller(ProductController::class)->group(function(){
    Route::post('storeproduct', 'storeProduct')->middleware(['permission:add product']);
    Route::get('showproduct/{id}', 'showproduct')->middleware(['permission:view product']);
    Route::get('showallproduct', 'index')->middleware(['permission:view all product ']);
    Route::post('updateproduct/{id}', 'updateProduct')->middleware(['permission:edit product|edit all product']);
    Route::delete('deleteproduct/{id}', 'deleteProdcut')->middleware(['permission:delete product|delete all product']);
});

Route::controller(CategoryController::class)->group(function(){
    Route::get('showallcategory', 'index')->middleware(['permission:view all category']);
    Route::post('storecategory', 'storeCategory')->middleware(['permission:add category']);
    Route::get('showcategory/{id}', 'showCategory')->middleware(['permission:view category']);
    Route::put('updatecategory/{id}', 'updateCategory')->middleware(['permission:edit category']);
    Route::delete('deletecategory/{id}', 'deleteCategory')->middleware(['permission:delete category']);
});

Route::controller(RoleController::class)->group(function(){
   Route::get('showrole/{id}', 'showRole')->middleware(['permission:view role']);
   Route::post('storerole', 'storeRole')->middleware(['permission:add role']);
   Route::put('updaterole/{id}', 'updateRole')->middleware(['permission:edit role']);
   Route::delete('deleterole/{id}', 'deleteRole')->middleware(['permission:delete role']);
});
Route::get('search/{category}', [SearchController ::class, 'Search']);