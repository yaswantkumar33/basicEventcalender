<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\calendercontroller;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/calender', [calendercontroller::class, 'index']);
Route::get('/login', [calendercontroller::class, 'login'])->name('login');
Route::get('/logout', [calendercontroller::class, 'logout'])->name('logout');
Route::get('/register', [calendercontroller::class, 'register']);
Route::post('/user/auth', [calendercontroller::class, 'userauth']);
Route::get('/mainevents', [calendercontroller::class, 'mainevents']);
Route::post('/calender/action', [calendercontroller::class, 'action']);