<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VaccineController;



Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::controller(VaccineController::class)->prefix('vaccine')->as('vaccine.')->group(function(){
    Route::get('/register','showRegistrationForm')->name('register');
    Route::post('/register', 'register')->name('register.submit');
    Route::get('/status','checkStatus')->name('status');
});