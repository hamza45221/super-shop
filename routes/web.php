<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/index',[\App\Http\Controllers\PagesController::class,'index'])->name('index');
Route::get('/about',[\App\Http\Controllers\PagesController::class,'about'])->name('about');
Route::get('/account',[\App\Http\Controllers\PagesController::class,'account'])->name('account');
Route::get('/checkout',[\App\Http\Controllers\PagesController::class,'checkout'])->name('checkout');
Route::get('/faq',[\App\Http\Controllers\PagesController::class,'faq'])->name('faq');
Route::get('/contacts',[\App\Http\Controllers\PagesController::class,'contacts'])->name('contacts');
Route::get('/goods-compare',[\App\Http\Controllers\PagesController::class,'goodsCompare'])->name('goods.compare');
Route::get('/items',[\App\Http\Controllers\PagesController::class,'items'])->name('items');
Route::get('/privacy-policy',[\App\Http\Controllers\PagesController::class,'privacyPolicy'])->name('privacy.policy');
Route::get('/product-list',[\App\Http\Controllers\PagesController::class,'productList'])->name('product.list');
Route::get('/search',[\App\Http\Controllers\PagesController::class,'search'])->name('search');
Route::get('/shopping-cart',[\App\Http\Controllers\PagesController::class,'shoppingCart'])->name('shopping.cart');
Route::get('/shopping-cart-null',[\App\Http\Controllers\PagesController::class,'shoppingCartNull'])->name('shopping.cart.null');
Route::get('/standart-forms',[\App\Http\Controllers\PagesController::class,'standartForms'])->name('standart.forms');
Route::get('/terms-condition',[\App\Http\Controllers\PagesController::class,'termsCondition'])->name('terms.condition');
Route::get('/wishlist',[\App\Http\Controllers\PagesController::class,'wishlist'])->name('wishlist');




//========================


Route::get('/',[\App\Http\Controllers\Admin\DashboardController::class,'index'])->name('admin.dashboard');

Route::group(['prefix'=>'user'],function(){
    Route::get('/',[\App\Http\Controllers\Admin\UserController::class,'index'])->name('admin.user');
    Route::get('/fetch',[\App\Http\Controllers\Admin\UserController::class,'fetch'])->name('admin.user.fetch');
    Route::post('/store',[\App\Http\Controllers\Admin\UserController::class,'store'])->name('admin.user.store');
    Route::get('/delete/{id}',[\App\Http\Controllers\Admin\UserController::class,'deleteUser'])->name('admin.user.delete');
    Route::get('/delete-multiple',[\App\Http\Controllers\Admin\UserController::class,'deleteMultiple'])->name('admin.user.delete-multiple');
});
