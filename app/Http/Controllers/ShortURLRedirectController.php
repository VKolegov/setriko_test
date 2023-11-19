<?php

namespace App\Http\Controllers;

use App\Models\ShortURL;
use Illuminate\Http\RedirectResponse;

class ShortURLRedirectController extends Controller
{
    public function redirect(ShortURL $shortURL): RedirectResponse
    {
        $shortURL->hits++;
        $shortURL->save();

        return redirect(
            $shortURL->destination_url
        );
    }
}
