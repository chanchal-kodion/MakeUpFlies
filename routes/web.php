<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Controllers\User\CartController as UserCartController;
use App\Http\Controllers\User\AuthController as AuthCartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/phpinfo', function() {
    return phpinfo();
});

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/admin')->group(function(){
    Route::get('login', [AdminController::class, 'login']);
    Route::post('login', [AdminController::class, 'login']);
    Route::group(['middleware'=>['admin']],function(){
        Route::get('dashboard', [AdminController::class,'dashboard']);
        Route::get('logout', [AdminController::class,'logout']);
        Route::get('update_password', [AdminController::class,'update_password']);
        Route::post('update_password', [AdminController::class,'update_password']);
        Route::get('update_admin_details', [AdminController::class,'updateAdminDetails']);
        Route::post('update_admin_details', [AdminController::class,'updateAdminDetails']);
        Route::post('check-current-password', [AdminController::class,'checkCurrentPassword']);
        // cmspages routes
        Route::get('cms-pages', [CmsController::class,'index']);
        Route::post('update-cms-page-status', [CmsController::class,'update']);
        Route::get('add-edit-cms-page/{id?}', [CmsController::class,'edit']);
        Route::post('add-edit-cms-page/{id?}', [CmsController::class,'edit']);
        Route::get('delete-cms-page/{id}', [CmsController::class,'destroy']);
        // subadmin routes
        Route::get('subadmins', [AdminController::class,'subadmins']);
        Route::post('update-subadmin-status', [AdminController::class,'updateSubadminStatus']);
        Route::get('delete-subadmin/{id}', [AdminController::class,'deleteSubadmin']);
        Route::get('add-edit-subadmin/{id?}', [AdminController::class,'addEditSubadmin']);
        Route::post('add-edit-subadmin/{id?}', [AdminController::class,'addEditSubadmin']);
        Route::get('update-role/{id?}', [AdminController::class,'updateRole']);
        Route::post('update-role/{id?}', [AdminController::class,'updateRole']);
        // category routes
        Route::get('categories', [CategoryController::class,'categories']);
        Route::post('update-category-status', [CategoryController::class,'updateCategoryStatus']);
        Route::get('delete-category/{id}', [CategoryController::class,'deleteCategory']);
        Route::get('delete-category-image/{id}', [CategoryController::class,'deleteCategoryImage']);
        Route::get('add-edit-category/{id?}', [CategoryController::class,'addEditCategory']);
        Route::post('add-edit-category/{id?}', [CategoryController::class,'addEditCategory']);
        // Products routes
        Route::get('products', [ProductController::class,'products']);
        Route::post('update-product-status', [ProductController::class,'updateProductStatus']);
        Route::get('delete-product/{id}', [ProductController::class,'deleteProduct']);
        Route::get('delete-product-image/{id}', [ProductController::class,'deleteProductImage']);
        Route::get('add-edit-product/{id?}', [ProductController::class,'addEditProduct']);
        Route::post('add-edit-product/{id?}', [ProductController::class,'addEditProduct']);
        
    });
});

Route::prefix('/user')->group(function(){
    Route::get('dashboard' , [UserProductController::class,'showdashboard']);
    Route::get('product' , [UserProductController::class,'showdashboard']);
    Route::get('cart' , [UserCartController::class,'cart']);
    Route::get('add-to-cart' , [UserCartController::class,'addToCart']);
    Route::post('add-to-cart' , [UserCartController::class,'addToCart']);
    Route::post('update-cart' , [UserCartController::class,'updateCart']);
    Route::post('update-cart' , [UserCartController::class,'updateCart']);
    Route::post('delete-item' , [UserCartController::class,'deleteItem']);
    Route::post('check-quantity' , [UserCartController::class,'checkQuantity']);
    Route::post('check-quantity-sub' , [UserCartController::class,'checkQuantityForSub']);
});

Route::get('register', [AuthCartController::class, 'register']);