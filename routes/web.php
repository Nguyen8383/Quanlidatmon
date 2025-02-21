<?php

use App\Http\Controllers\CategoryController; //rồi
use App\Http\Controllers\CartController; //rồi
use App\Http\Controllers\FoodController; 
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\Order_detailController;
use App\Http\Controllers\Payment_methodController;
use App\Http\Controllers\Order_statusController;
use App\Http\Controllers\Shipping_addressController;

//thiếu
use App\Http\Controllers\Cart_detailController;
use App\Http\Controllers\Failed_jobController;
use App\Http\Controllers\MigrationController;
use App\Http\Controllers\Password_reset_tokenController;
use App\Http\Controllers\Personal_access_tokenController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('layout.app');
});

// Category Routes
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/search', [CategoryController::class, 'search'])->name('category.search');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');


// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('carts.index');
Route::get('/cart/search', [CartController::class, 'search'])->name('carts.search');
Route::get('/cart/create', [CartController::class, 'create'])->name('carts.create');
Route::post('/cart/store', [CartController::class, 'store'])->name('carts.store');
Route::put('/cart/{id}', [CartController::class, 'update'])->name('carts.update');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('carts.destroy');
Route::get('/cart/{id}', [CartController::class, 'show'])->name('carts.show');

// Food Routes
Route::get('/food', [FoodController::class, 'index'])->name('foods.index');
Route::get('/food/create', [FoodController::class, 'create'])->name('foods.create');
Route::get('food/search', [FoodController::class, 'search'])->name('foods.search');
Route::post('/food/store', [FoodController::class, 'store'])->name('foods.store');
Route::put('/food/{id}', [FoodController::class, 'update'])->name('foods.update');
Route::delete('/food/{id}', [FoodController::class, 'destroy'])->name('foods.destroy');
Route::get('/food/{id}', [FoodController::class, 'show'])->name('foods.show');

// Order Routes
Route::get('/order', [OrderController::class, 'index'])->name('orders.index');
Route::get('/order/create', [OrderController::class, 'create'])->name('orders.create');
Route::post('/order/store', [OrderController::class, 'store'])->name('orders.store');
Route::put('/order/{id}', [OrderController::class, 'update'])->name('orders.update');
Route::delete('/order/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
Route::get('/order/{id}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/order/{id}/edit', [OrderController::class, 'edit'])->name('order.edit');

// Discount Routes
Route::get('/discount', [DiscountController::class, 'index'])->name('discount.index');
Route::get('/discount/create', [DiscountController::class, 'create'])->name('discount.create');
Route::post('/discount/store', [DiscountController::class, 'store'])->name('discount.store');
Route::put('/discount/{id}', [DiscountController::class, 'update'])->name('discount.update');
Route::delete('/discount/{id}', [DiscountController::class, 'destroy'])->name('discount.destroy');
Route::get('/discount/{id}', [DiscountController::class, 'show'])->name('discount.show');
Route::get('/discount/{id}/edit', [DiscountController::class, 'edit'])->name('discount.edit');

// Employee Routes
Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
Route::post('/employee/store', [EmployeeController::class, 'store'])->name('employee.store');
Route::put('/employee/{id}', [EmployeeController::class, 'update'])->name('employee.update');
Route::delete('/employee/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
Route::get('/employee/{id}', [EmployeeController::class, 'show'])->name('employee.show');

// Customer Routes
Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');
Route::put('/customer/{id}', [CustomerController::class, 'update'])->name('customer.update');
Route::delete('/customer/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');
Route::get('/customer/{id}', [CustomerController::class, 'show'])->name('customer.show');

// Invoice Routes
Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice.index');
Route::get('/invoice/create', [InvoiceController::class, 'create'])->name('invoice.create');
Route::post('/invoice/store', [InvoiceController::class, 'store'])->name('invoice.store');
Route::put('/invoice/{id}', [InvoiceController::class, 'update'])->name('invoice.update');
Route::delete('/invoice/{id}', [InvoiceController::class, 'destroy'])->name('invoice.destroy');
Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->name('invoice.show');

// OrderDetail Routes
Route::get('/order-detail', [Order_detailController::class, 'index'])->name('order_detail.index');
Route::get('/order-detail/create', [Order_detailController::class, 'create'])->name('order_detail.create');
Route::post('/order-detail/store', [Order_detailController::class, 'store'])->name('order_detail.store');
Route::put('/order-detail/{id}', [Order_detailController::class, 'update'])->name('order_detail.update');
Route::delete('/order-detail/{id}', [Order_detailController::class, 'destroy'])->name('order_detail.destroy');
Route::get('/order-detail/{id}', [Order_detailController::class, 'show'])->name('order_detail.show');

// Payment Method Routes
Route::get('/payment-method', [Payment_methodController::class, 'index'])->name('payment_method.index');
Route::get('/payment-method/create', [Payment_methodController::class, 'create'])->name('payment_method.create');
Route::post('/payment-method/store', [Payment_methodController::class, 'store'])->name('payment_method.store');
Route::put('/payment-method/{id}', [Payment_methodController::class, 'update'])->name('payment_method.update');
Route::delete('/payment-method/{id}', [Payment_methodController::class, 'destroy'])->name('payment_method.destroy');
Route::get('/payment-method/{id}', [Payment_methodController::class, 'show'])->name('payment_method.show');

// Order Status Routes
Route::get('/order-status', [Order_statusController::class, 'index'])->name('order_status.index');
Route::get('/order-status/create', [Order_statusController::class, 'create'])->name('order_status.create');
Route::post('/order-status/store', [Order_statusController::class, 'store'])->name('order_status.store');
Route::put('/order-status/{id}', [Order_statusController::class, 'update'])->name('order_status.update');
Route::delete('/order-status/{id}', [Order_statusController::class, 'destroy'])->name('order_status.destroy');
Route::get('/order-status/{id}', [Order_statusController::class, 'show'])->name('order_status.show');

// Shipping Address Routes
Route::get('/shipping-address', [Shipping_addressController::class, 'index'])->name('shipping_address.index');
Route::get('/shipping-address/create', [Shipping_addressController::class, 'create'])->name('shipping_address.create');
Route::post('/shipping-address/store', [Shipping_addressController::class, 'store'])->name('shipping_address.store');
Route::put('/shipping-address/{id}', [Shipping_addressController::class, 'update'])->name('shipping_address.update');
Route::delete('/shipping-address/{id}', [Shipping_addressController::class, 'destroy'])->name('shipping_address.destroy');
Route::get('/shipping-address/{id}', [Shipping_addressController::class, 'show'])->name('shipping_address.show');

// CartDetail Routes
Route::get('/cart-detail', [Cart_detailController::class, 'index'])->name('cart_detail.index');
Route::get('/cart-detail/create', [Cart_detailController::class, 'create'])->name('cart_detail.create');
Route::post('/cart-detail/store', [Cart_detailController::class, 'store'])->name('cart_detail.store');
Route::put('/cart-detail/{id}', [Cart_detailController::class, 'update'])->name('cart_detail.update');
Route::delete('/cart-detail/{id}', [Cart_detailController::class, 'destroy'])->name('cart_detail.destroy');
Route::get('/cart-detail/{id}', [Cart_detailController::class, 'show'])->name('cart_detail.show');

// Failed Job Routes
Route::get('/failed-jobs', [Failed_jobController::class, 'index'])->name('failed_jobs.index');
Route::get('/failed-jobs/{id}', [Failed_jobController::class, 'show'])->name('failed_jobs.show');

// Migration Routes
Route::get('/migrations', [MigrationController::class, 'index'])->name('migrations.index');
Route::get('/migrations/create', [MigrationController::class, 'create'])->name('migrations.create');
Route::post('/migrations/store', [MigrationController::class, 'store'])->name('migrations.store');
Route::put('/migrations/{id}', [MigrationController::class, 'update'])->name('migrations.update');
Route::delete('/migrations/{id}', [MigrationController::class, 'destroy'])->name('migrations.destroy');

// Password Reset Token Routes
Route::get('/password-reset-tokens', [Password_reset_tokenController::class, 'index'])->name('password_reset_tokens.index');
Route::get('/password-reset-tokens/{id}', [Password_reset_tokenController::class, 'show'])->name('password_reset_tokens.show');

// Personal Access Token Routes
Route::get('/personal-access-tokens', [Personal_access_tokenController::class, 'index'])->name('personal_access_tokens.index');
Route::get('/personal-access-tokens/{id}', [Personal_access_tokenController::class, 'show'])->name('personal_access_tokens.show');

// User Routes
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
