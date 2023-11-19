<?php

namespace App\Http\Requests;

class UpdateShortUrlRequest extends CreateShortUrlRequest
{
    public function rules(): array
    {
        $rules = parent::rules();

        unset($rules['slug']);

        return $rules;
    }
}
