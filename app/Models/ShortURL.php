<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * \App\Models\ShortURL
 *
 * @property int $id
 * @property string $slug Короткий ключ
 * @property string $destination_url Адрес для перенаправления
 * @property string|null $name Название ссылки
 * @property int $hits Количество переходов
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ShortURL newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShortURL newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShortURL query()
 * @mixin \Eloquent
 */
class ShortURL extends Model
{
    protected $table = 'short_urls';

    protected $casts = [
        'hits' => 'int',
    ];

    protected $guarded = ['id', 'slug'];
}
