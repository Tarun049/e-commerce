<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CartController;

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
// })->name("home");

Route::get('/',[WelcomeController::class, 'showHomeProducts'])->name("index");

// Route::get('/shop', function () {
//     return view('shop');
// })->name("shop");

// Route::get('/contact', function () {
//     return view('contact');
// })->name("contact");

// Route::get('/checkout', function () {
//     return view('checkout');
// })->name("checkout");

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {

    Route::get("dashboard", [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name("admin_dashboard");
   
    // routes to add the product
    Route::get("/add-product", [ProductController::class, 'index'])->name('add_product');
    Route::post("/add-product", [ProductController::class, "create"])->name('create_product');

    // route to show the product
    Route::get("/show-product", [ProductController::class, "showProducts"])->name('show_product');

    // rotues to update the product
    Route::get("/update-product/{product_id}", [ProductController::class, "edit"])->name('update_product_form');
    Route::post("/update-product", [ProductController::class, "update"])->name('update_product');

    // route to delete the product
    Route::get("/delete-product/{product_id}", [ProductController::class, "destroy"])->name('delete_product');
});


Route::prefix('product')->group(function () {
    Route::get("detail/{product_id}", [WelcomeController::class, "singleProductDetail"])->name("product_detail");
    Route::post("add-to-cart", [CartController::class, "addToCart"])->name("add_to_cart");
});

Route::prefix('cart')->group(function () {
    Route::get("show-list", [CartController::class, "productsOnCart"])->name("product_cart");
});

// Route::get('/cart', function () {
//     return view('cart');
// })->name("cart");
