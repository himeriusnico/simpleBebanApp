<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// route sidebar khusus tiap role
Route::middleware(['auth'])->group(function () {
    Route::get('/beban', function () {
        return view('beban.index');
    })->name('beban.index');

    Route::get('/kategori-beban', function () {
        return view('kategori-beban.index');
    })->name('kategori_beban.index');
});