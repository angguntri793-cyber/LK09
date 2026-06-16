<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;

// 1. HALAMAN UTAMA / LOGIN
Route::get('/', function () {
    // Jika sudah login, lempar ke books. Jika belum, lempar ke login.
    return auth()->check() ? redirect('/books') : redirect('/login');
});

Route::get('/login', function () {
    return view('auth.login'); // Membuka file resources/views/auth/login.blade.php
})->name('login');


// 2. PROTEKSI ROUTE BOOKS (Hanya untuk yang sudah login)
Route::resource('books', BookController::class)->middleware('auth');


// 3. AUTH WORKOS
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/callback', [AuthController::class, 'handleCallback']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// DEBUG WORKOS (sementara)
Route::get('/test-workos', function () {
    // Info tambahan untuk debug instansiasi statis SDK
    \WorkOS\WorkOS::setApiKey(env('WORKOS_API_KEY'));
    $sso = new \WorkOS\SSO();
    dd(get_class_methods($sso));
});