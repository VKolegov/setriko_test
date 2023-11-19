<?php

use Illuminate\Support\Facades\Route;

// prefix: /l

use App\Http\Controllers\ShortURLRedirectController;

Route::get('/{shortURL:slug}', [ShortURLRedirectController::class, 'redirect']);