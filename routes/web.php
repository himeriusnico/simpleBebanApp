<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Auth\Access\Gate;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::livewire('/beban', 'beban-table')->name('beban.index');

    Route::livewire('/kategori-beban', 'kategori-beban')->name('kategori_beban.index')->can('view-kategori-beban');
});

// route sidebar khusus tiap role
// Route::middleware(['auth'])->group(function () {
//     Route::get('/beban', function () {
//         return view('beban.index');
//     })->name('beban.index');

//     Route::get('/kategori-beban', function () {
//         // Gate::authorize('view-kategori-beban');
//         return view('kategori-beban.index');
//     })->name('kategori_beban.index')->can('view-kategori-beban'); 
//     // Nah protect route pake can
//     // Developer kasih 2 alternatif, ada yang suka handle authorization level di route, tapi ada yang suka handle di controller atau within closure {di dalam}--laracast

// });

// Redirecting to full-page components
// Route::livewire('/posts', 'pages::show-posts');
// Creating Policies

