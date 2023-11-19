<?php

use Illuminate\Support\Facades\Route;

// prefix: /l

use App\Http\Controllers\ShortUrlRedirectController;

Route::get('/{slug}', [ShortUrlRedirectController::class, 'redirect'])
    ->name('short-url');