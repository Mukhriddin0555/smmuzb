<?php

namespace App\Models;

use App\Models\SaleProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\TelegramUser
 *
 * @property int $id
 * @property int $telegram_id
 * @property int $number
 * @property string $last_name
 * @property string $first_name
 * @property int $client_status_id
 * @property int $discount_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramUser whereClientStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramUser whereDiscountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramUser whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramUser whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramUser whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramUser whereTelegramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramUser whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TelegramUser extends Model
{
    use HasFactory;

    public $with = 'saleproducts';

    public function saleproducts(){
        return $this->hasMany(SaleProduct::class, 'telegram_user_id', 'id')->orderByDesc('created_at');
    }
}
