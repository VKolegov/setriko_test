<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * \App\Models\ShortURL
 *
 * @property int $id
 * @property string $slug Короткий ключ
 * @property string $destination_url Адрес для перенаправления
 * @property string|null $name Название ссылки
 * @property int $hits Количество переходов
 * @property Carbon|null $created_at
 * @method static Builder|ShortURL newModelQuery()
 * @method static Builder|ShortURL newQuery()
 * @method static Builder|ShortURL query()
 * @mixin Eloquent
 */
class ShortURL extends Model
{
    protected $table = 'short_urls';

    protected $casts = [
        'hits' => 'int',
    ];

    protected $guarded = ['id', 'slug'];

    public const UPDATED_AT = null;
}
