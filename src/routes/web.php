<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ThanksController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ChargeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\MailController;




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
    Route::get('/checkout', [ChargeController::class, 'checkout'])->name('checkout');
    Route::post('/charge', [ChargeController::class, 'charge'])->name('charge');
    Route::get('/complete', [ChargeController::class, 'complete'])->name('complete');
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.login.logout');
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit');
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::post('/admin/owners/register', [AdminController::class, 'registerOwner'])->name('admin.owners.register.submit');
    Route::post('/admin/send/bulk/mail', [MailController::class, 'sendBulkMail'])->name('send.bulk.mail');
    Route::get('/admin/send/bulk/mail', [MailController::class, 'sendBulkMail'])->name('send.bulk.mail');
});

Route::prefix('owner')->group(function () {
    Route::get('/login', [OwnerController::class, 'showLoginForm'])->name('owner.login');
    Route::post('/login', [OwnerController::class, 'login'])->name('owner.login.submit');
});

Route::middleware(['auth:owner'])->group(function () {
    Route::get('/owner/dashboard', [OwnerController::class, 'index'])->name('owner.dashboard');
    Route::get('/owner/shop/add', [OwnerController::class, 'showAddShopForm'])->name('owner.shop.add');
    Route::post('/owner/shop/store', [OwnerController::class, 'storeShop'])->name('owner.shop.store');
    Route::get('/owner/shop/done', [OwnerController::class, 'showDonePage'])->name('owner.shop.done');
    Route::get('/owner/shop/edit/{id}', [OwnerController::class, 'showEditShopForm'])->name('owner.shop.edit');
    Route::put('/owner/shop/update/{id}', [OwnerController::class, 'updateShop'])->name('owner.shop.update');
    Route::get('/owner/shop/edit/done', [OwnerController::class, 'updateShop'])->name('owner.shop.edit.done');
    Route::get('/owner/reservations', [OwnerController::class, 'showReservations'])->name('owner.reservations');


});




