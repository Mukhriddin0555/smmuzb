<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ClientStatus
 *
 * @property int $id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ClientStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientStatus whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientStatus whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ClientStatus extends Model
{
    use HasFactory;
}
