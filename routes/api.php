<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UnitController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\SetupController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\MenuTypeController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\UnitProductsController;
use App\Http\Controllers\Api\OrderCategoryController;
use App\Http\Controllers\Api\ProductOrdersController;
use App\Http\Controllers\Api\MenuTypeOrdersController;
use App\Http\Controllers\Api\ProductCategoryController;
use App\Http\Controllers\Api\CompanyCustomersController;
use App\Http\Controllers\Api\OrderCategoryOrdersController;
use App\Http\Controllers\Api\ProductCategoryProductsController;

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

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('users', UserController::class);

        Route::apiResource('order-categories', OrderCategoryController::class);

        // OrderCategory Orders
        Route::get('/order-categories/{orderCategory}/orders', [
            OrderCategoryOrdersController::class,
            'index',
        ])->name('order-categories.orders.index');
        Route::post('/order-categories/{orderCategory}/orders', [
            OrderCategoryOrdersController::class,
            'store',
        ])->name('order-categories.orders.store');

        Route::apiResource(
            'product-categories',
            ProductCategoryController::class
        );

        // ProductCategory Products
        Route::get('/product-categories/{productCategory}/products', [
            ProductCategoryProductsController::class,
            'index',
        ])->name('product-categories.products.index');
        Route::post('/product-categories/{productCategory}/products', [
            ProductCategoryProductsController::class,
            'store',
        ])->name('product-categories.products.store');

        // ProductCategory Products
        Route::get('/product-categories/{productCategory}/products', [
            ProductCategoryProductsController::class,
            'index',
        ])->name('product-categories.products.index');
        Route::post('/product-categories/{productCategory}/products', [
            ProductCategoryProductsController::class,
            'store',
        ])->name('product-categories.products.store');

        Route::apiResource('menu-types', MenuTypeController::class);

        // MenuType Orders
        Route::get('/menu-types/{menuType}/orders', [
            MenuTypeOrdersController::class,
            'index',
        ])->name('menu-types.orders.index');
        Route::post('/menu-types/{menuType}/orders', [
            MenuTypeOrdersController::class,
            'store',
        ])->name('menu-types.orders.store');

        Route::apiResource('products', ProductController::class);

        // Product Orders
        Route::get('/products/{product}/orders', [
            ProductOrdersController::class,
            'index',
        ])->name('products.orders.index');
        Route::post('/products/{product}/orders', [
            ProductOrdersController::class,
            'store',
        ])->name('products.orders.store');

        Route::apiResource('orders', OrderController::class);

        Route::apiResource('units', UnitController::class);

        // Unit Products
        Route::get('/units/{unit}/products', [
            UnitProductsController::class,
            'index',
        ])->name('units.products.index');
        Route::post('/units/{unit}/products', [
            UnitProductsController::class,
            'store',
        ])->name('units.products.store');

        Route::apiResource('customers', CustomerController::class);

        Route::apiResource('setups', SetupController::class);

        Route::apiResource('companies', CompanyController::class);

        // Company Customers
        Route::get('/companies/{company}/customers', [
            CompanyCustomersController::class,
            'index',
        ])->name('companies.customers.index');
        Route::post('/companies/{company}/customers', [
            CompanyCustomersController::class,
            'store',
        ])->name('companies.customers.store');
    });
