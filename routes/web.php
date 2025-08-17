<?php

use App\Http\Controllers\HomePageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PurchasedCourseController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\WalletController;

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/', [HomePageController::class, 'index'])->name('welcome');

// Auth
Route::middleware('guest')->group(function () {
    Route::view('/login', 'auth.login')->name('login'); // Done
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register'); // Done
    Route::post('/register', [RegisterController::class, 'register'])->name('register.store'); // Done
    Route::post('/login', [LoginController::class, 'login'])->name('login.store'); // Done
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Courses
Route::prefix('courses')->name('courses.')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('index'); // Done
    Route::get('{course:slug}', [CourseController::class, 'show'])->name('show'); // Done
    Route::post('{course}/buy', [CourseController::class, 'purchase'])->name('purchase'); // Done
    Route::post('{course}/enroll', [CourseController::class, 'enroll'])->name('enroll'); // Not done
    Route::get('{course}/sections/{section}', [CourseController::class, 'showSection'])->name('sections.show');
    Route::post('{course}/favorite', [CourseController::class, 'toggleFavorite'])->name('favorite.toggle'); // Done
    Route::post('{course}/rate', [CourseController::class, 'rate'])->name('rate'); // Not done
});

// User Profile
Route::prefix('profile')->middleware('auth')->name('profile.')->group(function () { // done
    Route::get('/', [UserController::class, 'show'])->name('show');
    Route::post('update', [UserController::class, 'update'])->name('update');
    Route::post('password', [UserController::class, 'updatePassword'])->name('password');
});

// Trainer Application
Route::prefix('trainer')->middleware('auth')->name('trainer.')->group(function () {
    Route::get('apply', [TrainerController::class, 'showForm'])->name('apply'); // not done
    Route::post('apply', [TrainerController::class, 'submitApplication'])->name('submit');
});

// Favorites
Route::get('/favorites', [FavoriteController::class, 'index'])->middleware('auth')->name('favorites.index'); // Done

// Purchased Courses
Route::get('/my-courses', [PurchasedCourseController::class, 'index'])->middleware('auth')->name('courses.purchased'); // Done

// Voucher
Route::post('/vouchers/redeem', [VoucherController::class, 'redeem'])->middleware('auth')->name('vouchers.redeem'); // Not done

// Wallet
Route::get('/wallet', [WalletController::class, 'index'])->middleware('auth')->name('wallet.index'); // Done
