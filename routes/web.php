<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about', ['nama' => 'Tri Bayu']);
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/login', function () {
    return view('auth/login');
});

Route::get('/register', function () {
    return view('auth/register');
});

Route::get('/profile', function () {
    return view('profile');
});



use App\Http\Controllers\Auth\RegisterController;

// Form register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

// Proses register
Route::post('/register', [AuthController::class, 'processRegister'])->name('register.process');

// Form login (sudah kamu punya)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin'])->name('login.process');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/profile', function () {
    if (!Auth::check()) {
        return redirect('/login')->with('error', 'You must login first.');
    }
    return view('profile'); 
})->name('profile');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login')->with('success', 'You have been logged out.');
})->name('logout');
