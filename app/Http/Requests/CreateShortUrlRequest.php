<?php

namespace App\Http\Requests;

use App\Helpers\SlugGenerator;
use App\Models\ShortUrl;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateShortUrlRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'slug'            => [
                'alpha_num',
                'max:' . SlugGenerator::MAX_CHARS,
                Rule::unique(ShortUrl::class, 'slug')
            ],
            'name'            => ['string', 'max:255'],
            'destination_url' => ['required', 'url', 'max:2048'],
        ];
    }
}
