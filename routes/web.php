<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('/type', TypeController::class);
    Route::resource('/status', StatusController::class);
    Route::resource('/film', FilmController::class);
    Route::resource('/genre', GenreController::class);
    Route::resource('/network', NetworkController::class);

    Route::get('/import-genre', [GenreController::class, 'import'])->name('import.genre');
    Route::post('/import-genre', [GenreController::class, 'importStore'])->name('import.genre');
    Route::get('/export-genre', [GenreController::class, 'export'])->name('export.genre');
    Route::get('/import-type', [TypeController::class, 'import'])->name('import.type');
    Route::post('/import-type', [TypeController::class, 'importStore'])->name('import.type');
    Route::get('/export-type', [TypeController::class, 'export'])->name('export.type');
    Route::get('/import-network', [NetworkController::class, 'import'])->name('import.network');
    Route::post('/import-network', [NetworkController::class, 'importStore'])->name('import.network');
    Route::get('/export-network', [NetworkController::class, 'export'])->name('export.network');


    Route::get('/dashboard/profile', [ProfileController::class, 'index'])->name('profile.index');

    Route::get('/change-password', [ChangePasswordController::class, 'index'])->name('change.password');
    Route::post('/change-password', [ChangePasswordController::class, 'update'])->name('post.change.password');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});


Route::middleware('guest')->group(function () {
    // Login & register
    Route::get('register', [RegistrationController::class, 'index'])->name('register');
    Route::post('register', [RegistrationController::class, 'authenticate'])->name('register');
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::get('reload-captcha', [LoginController::class, 'reloadCaptcha']);

    // Forgot password
    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::get('forgot-password', 'showEmail')->name('forgot.index');
        Route::post('forgot-password', 'sendEmail')->name('forgot.store');
        Route::get('reset-password/{token}', 'showResetPasswordForm')->name('reset.index');
        Route::post('reset-password', 'storeResetPassword')->name('reset.store');
    });
});
