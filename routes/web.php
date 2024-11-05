<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'index'])->name('index');

Route::get('/category/{slug}',[HomeController::class,'kosByCategory'])->name('kosByCategory');

Route::get('/city/{slug}',[HomeController::class,'kosByCity'])->name('kosByCity');

Route::get('/check-booking',[HomeController::class,'check'])->name('check');

Route::get('/find',[HomeController::class,'find'])->name('find');

Route::get('/details/{slug}',[HomeController::class,'details'])->name('details');

Route::get('/rooms/{slug}',[HomeController::class,'rooms'])->name('rooms');

Route::get('/booking/{slug}',[HomeController::class,'booking'])->name('booking');

Route::get('/booking/{slug}/information',[HomeController::class,'information'])->name('information');

Route::post('/booking/{slug}/information/save',[HomeController::class,'information_save'])->name('information_save');

Route::get('/booking/{slug}/checkout',[HomeController::class,'checkout'])->name('checkout');

Route::post('/booking/{slug}/payment',[HomeController::class,'payment'])->name('payment');
