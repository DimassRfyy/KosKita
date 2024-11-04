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
