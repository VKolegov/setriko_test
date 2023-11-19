<?php

use Illuminate\Support\Facades\Route;

// prefix: /l

use App\Http\Controllers\ShortURLRedirectController;

Route::get('/{slug}', [ShortURLRedirectController::class, 'redirect']);