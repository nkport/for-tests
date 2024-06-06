<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ルーティングを設定するコントローラを宣言する
use App\Http\Controllers\HelloController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ResponseController;

// セキュリティ動作確認
use App\Http\Controllers\SignInController;

use App\Http\Controllers\CookieController;
use App\Http\Controllers\SessionController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/hello', [HelloController::class, 'index']);

Route::get('/products', [ProductController::class, 'index']);

Route::get('/products/create', [ProductController::class, 'create']);

Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');

Route::get('/products/{id}', [ProductController::class, 'show']);

// Route::get('/vendors/create', [VendorController::class, 'create']);
Route::get('/vendors/create', [VendorController::class, 'create'])->middleware('auth');

// Route::post('/vendors/store', [VendorController::class, 'store'])->name('vendors.store');
Route::post('/vendors/store', [VendorController::class, 'store'])->name('vendors.store')->middleware('auth');

Route::get('/vendors/{id}', [VendorController::class, 'show']);

Route::get('/requests/create', [RequestController::class, 'create']);

Route::post('/requests/confirm', [RequestController::class, 'confirm'])->name('requests.confirm');

Route::get('/responses', [ResponseController::class, 'index']);

// セキュリティ動作確認
Route::get('/sign-in', [SignInController::class, 'create']);
// セキュリティ動作確認
Route::post('/sign-in', [SignInController::class, 'store'])->name('sign-in.store');

Route::get('/cookies', [CookieController::class, 'index']);

Route::get('/cookies/create', [CookieController::class, 'create'])->name('cookies.create');

Route::post('/cookies/store', [CookieController::class, 'store'])->name('cookies.store');

Route::delete('/cookies/destroy', [CookieController::class, 'destroy'])->name('cookies.destroy');

Route::get('/sessions', [SessionController::class, 'index']);

Route::get('/sessions/create', [SessionController::class, 'create'])->name('sessions.create');

Route::post('/sessions/store', [SessionController::class, 'store'])->name('sessions.store');

Route::delete('/sessions/destroy', [SessionController::class, 'destroy'])->name('sessions.destroy');
