<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SaleProduct
 *
 * @property int $id
 * @property int $telegram_user_id
 * @property int $price_amount
 * @property int $discount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SaleProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleProduct whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleProduct wherePriceAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleProduct whereTelegramUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SaleProduct extends Model
{
    use HasFactory;
    
    public $with = 'customersalesman';

    public function customersalesman(){
        return $this->hasOne(customersalesman::class, 'id', 'customer_salesman_id');
    }
}
