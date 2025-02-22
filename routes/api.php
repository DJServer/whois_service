<?php

use App\Http\Controllers\API\WhoisController;
use Illuminate\Support\Facades\Route;

Route::get('/whois', [WhoisController::class, 'lookup']);
