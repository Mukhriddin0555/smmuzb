<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\NotActive
 *
 * @property int $id
 * @property int $message_id
 * @property int $telegram_id
 * @property string|null $last_name
 * @property string|null $first_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|NotActive newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotActive newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotActive query()
 * @method static \Illuminate\Database\Eloquent\Builder|NotActive whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotActive whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotActive whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotActive whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotActive whereMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotActive whereTelegramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotActive whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class NotActive extends Model
{
    use HasFactory;
}
