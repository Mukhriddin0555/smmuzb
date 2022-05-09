<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SaleToday
 *
 * @property int $id
 * @property int $sale_product_id
 * @property int $products_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SaleToday newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleToday newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleToday query()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleToday whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleToday whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleToday whereProductsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleToday whereSaleProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleToday whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SaleToday extends Model
{
    use HasFactory;
}
