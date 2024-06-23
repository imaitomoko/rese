<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ThanksController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ReviewController;



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
Route::post('/shop/{id}/reviews', [ReviewController::class, 'store'])->name('shop.reviews.store');

Route::middleware(['auth'])->post('/store', [ReservationController::class, 'store'])->name('store');
Route::middleware(['auth'])->get('/done', [ReservationController::class, 'done'])->name('done');
Route::middleware(['auth'])->delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

Route::middleware(['auth'])->group(function () {
    Route::get('/mypage', [MypageController::class, 'index'])->name('index');
    Route::post('/favorite/{shop}', [FavoriteController::class, 'toggleFavorite'])->name('favorite.toggle');
    Route::get('/mypage/edit/{id}', [ReservationController::class, 'edit'])->name('mypage.edit');
    Route::put('/mypage/update/{id}', [ReservationController::class, 'update'])->name('mypage.update');
});



