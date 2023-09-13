<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ShippingController;
use App\Http\Middleware\IsAdminMiddleware;

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
    return view('home');
});

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//list
/*Route::group(['middleware'=>'auth'],function(){
    Route::group([
        'prefix'=>'admin',
        'middleware'=>'is_admin',
        'as'=>'admin/',
    ], function(){
        Route::get('/orders/list', [OrdersController::class,'listOrders']);
        Route::get('/users/list', [UsersController::class,'index']);
    });

    Route::group([
        'prefix'=>'user',
        'as'=>'user/',
    ], function(){
       
    });
});
*/
//listy
Route::get('/users/list', [UsersController::class,'index'])->middleware('auth');
Route::get('/users/profile', [UsersController::class,'getCurrentUserData'])->middleware('auth');
Route::get('/orders/list', [OrdersController::class,'index'])->middleware('auth');
Route::get('/products/lampki', [ProductsController::class,'lampkiList']);
Route::get('/products/dywany', [ProductsController::class,'dywanyList']);
Route::get('/products/tapety', [ProductsController::class,'tapetyList']);
Route::get('/shipping/list', [ShippingController::class,'index'])->middleware('auth');
Route::get('/orders/orderList', [OrdersController::class,'showOrder'])->middleware('auth');
Route::get('/orderdetails/list/{id}', [OrderDetailsController::class,'showOrderDetails'])->middleware('auth');
Route::get('products/list', [ProductsController::class,'index'])->middleware('auth');
Route::post('products/list/search', [ProductsController::class,'search'])->middleware('auth');
Route::post('users/list/search', [UsersController::class,'search'])->middleware('auth');

//dodawanie
Route::get('/products/add', [ProductsController::class,'create'])->middleware('auth');
Route::post('/products/save', [ProductsController::class,'store'])->middleware('auth');
Route::get('/shipping/add', [ShippingController::class,'create'])->middleware('auth');
Route::post('/shipping/save', [ShippingController::class,'store'])->middleware('auth');
//logowanie
Route::get('/loguj', [HomeController::class,'zmienStanUwierzytelnienia']); 
Route::get('/zalogowano', [HomeController::class,'zwrocZalogowano']); 
Route::get('/wyloguj',[HomeController::class,'zmienStanUwierzytelnienia']);
//wyświetlanie produktu
Route::get('/products/product/{id}', [ProductsController::class,'productShow']);

//card
Route::post('/products/product/{id}', [CartController::class,'addToCart'])->middleware('auth');
Route::get('/shop/shopping-cart', [CartController::class,'showCart'])->middleware('auth');
Route::get('/shop/checkout', [OrdersController::class,'checkoutList'])->middleware('auth');
Route::post('/shop/checkout/save', [OrdersController::class,'makeCheckout'])->middleware('auth');

//edit
Route::get('/orders/edit/{id}', [OrdersController::class,'edit'])->middleware('auth');
Route::post('/orders/update/{id}', [OrdersController::class,'update'])->middleware('auth');
Route::get('/users/edit/{id}', [UsersController::class,'edit'])->middleware('auth');
Route::post('/users/update/{id}', [UsersController::class,'update'])->middleware('auth');
Route::get('/users/editClient/{id}', [UsersController::class,'editClient'])->middleware('auth');
Route::post('/users/updateClient/{id}', [UsersController::class,'updateClient'])->middleware('auth');
Route::get('/products/edit/{id}', [ProductsController::class,'edit'])->middleware('auth');
Route::post('/products/update/{id}', [ProductsController::class,'update'])->middleware('auth');
//del 
Route::get('/orders/show/{id}', [OrdersController::class,'show'])->middleware('auth');
Route::post('/orders/delete/{id}', [OrdersController::class,'destroy'])->middleware('auth');
Route::get('/users/show/{id}', [UsersController::class,'show'])->middleware('auth');
Route::post('/users/delete/{id}', [UsersController::class,'destroy'])->middleware('auth');
Route::get('/products/show/{id}', [ProductsController::class,'show'])->middleware('auth');
Route::post('/products/delete/{id}', [ProductsController::class,'destroy'])->middleware('auth');
Route::get('/shop/show/{id}', [CartController::class,'show'])->middleware('auth');
Route::post('/shop/shopping-cart/delete/{id_cart}', [CartController::class,'destroy'])->middleware('auth');
require __DIR__.'/auth.php';