<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\HomeController;

Route::view('/welcome', 'welcome');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('language/{language:code}', [HomeController::class, 'changeLanguage'])->name('changeLanguage');