<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * \App\Models\ShortUrl
 *
 * @property int $id
 * @property string $slug Короткий ключ
 * @property string $destination_url Адрес для перенаправления
 * @property string|null $name Название ссылки
 * @property int $hits Количество переходов
 * @property Carbon|null $created_at
 * @method static Builder|ShortUrl newModelQuery()
 * @method static Builder|ShortUrl newQuery()
 * @method static Builder|ShortUrl query()
 * @mixin Eloquent
 */
class ShortUrl extends Model
{
    use HasFactory;

    protected $table = 'short_urls';

    protected $casts = [
        'hits' => 'int',
    ];

    protected $guarded = ['id'];

    public const UPDATED_AT = null;
}
