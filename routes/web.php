<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/produce', [PublicController::class, 'produce'])->name('produce');
Route::get('/investors', [PublicController::class, 'investors'])->name('investors');
