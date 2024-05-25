<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ThanksController;

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

Route::get('/', [ShopController::class, 'index']);
Route::get('/search', [ShopController::class, 'search']);
Route::get('/detail/{shop_id}', [ShopController::class, 'detail'])->name('detail');
Route::get('/thanks', function () {
    return view('thanks');
})->name('thanks');

Route::middleware(['auth'])->post('/store', [ReservationController::class, 'store'])->name('store');
Route::middleware(['auth'])->get('/done', [ReservationController::class, 'done'])->name('done');
Route::middleware(['auth'])->post('/favorite', [FavoriteController::class, 'toggleFavorite'])->name('favorite.toggle');


