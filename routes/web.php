<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WhoisHistoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/whois/history', [WhoisHistoryController::class, 'index'])->name('whois.history');
