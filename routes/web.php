<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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
route::get('admin', [AdminController::class, 'index']);
route::post('admin/auth', [AdminController::class, 'auth'])->name('admin.auth');

Route::group(['middleware' => 'Admin_auth'], function () {
    route::get('admin/dashboard', [AdminController::class, 'dashboard']);

    // *************category**********************
    route::get('admin/category', [CategoryController::class, 'index']);
    route::get('admin/category/manage_category', [CategoryController::class, 'manage_category']);
    route::get('admin/category/manage_category/{id}', [CategoryController::class, 'manage_category']);
    route::post('admin/category/manage_category_process', [CategoryController::class, 'manage_category_process'])->name('manage_category_process');
    route::get('admin/category/delete/{id}', [CategoryController::class, 'delete']);
    route::get('admin/category/status/{status}/{id}', [CategoryController::class, 'status']);

    // *************coupon**********************

    route::get('admin/coupon', [CouponController::class, 'index']);
    route::get('admin/coupon/manage_coupon', [CouponController::class, 'manage_coupon']);
    route::get('admin/coupon/manage_coupon/{id}', [CouponController::class, 'manage_coupon']);
    route::post('admin/coupon/manage_coupon_process', [CouponController::class, 'manage_coupon_process'])->name('manage_coupon_process');
    route::get('admin/coupon/status/{status}/{id}', [CouponController::class, 'status']);
    route::get('admin/coupon/delete/{id}', [CouponController::class, 'delete']);

    // *********************Size**************

    route::get('admin/size', [SizeController::class, 'index']);
    route::get('admin/size/manage_size', [SizeController::class, 'manage_size']);
    route::get('admin/size/manage_size/{id}', [SizeController::class, 'manage_size']);
    route::post('admin/size/manage_size_process', [SizeController::class, 'manage_size_process'])->name('manage_size_process');
    route::get('admin/size/status/{status}/{id}', [SizeController::class, 'status']);
    route::get('admin/size/delete/{id}', [SizeController::class, 'delete']);

    // *********************Color**************

    route::get('admin/color', [ColorController::class, 'index']);
    route::get('admin/color/manage_color', [ColorController::class, 'manage_color']);
    route::get('admin/color/manage_color/{id}', [ColorController::class, 'manage_color']);
    route::post('admin/color/manage_color_process', [ColorController::class, 'manage_color_process'])->name('manage_color_process');
    route::get('admin/color/status/{status}/{id}', [ColorController::class, 'status']);
    route::get('admin/color/delete/{id}', [ColorController::class, 'delete']);


    // *********************Product**************

    route::get('admin/product', [ProductController::class, 'index']);
    route::get('admin/product/manage_product', [ProductController::class, 'manage_product']);
    route::get('admin/product/manage_product/{id}', [ProductController::class, 'manage_product']);
    route::post('admin/product/manage_product_process', [ProductController::class, 'manage_product_process'])->name('manage_product_process');
    route::get('admin/product/status/{status}/{id}', [ProductController::class, 'status']);
    route::get('admin/product/delete/{id}', [ProductController::class, 'delete']);


    Route::get('admin/logout', function () {
        session()->forget('ADMIN_LOGIN');
        session()->forget('ADMIN_ID');
        session()->flash('error', 'Logout successfully');
        return redirect('admin');
    });
});