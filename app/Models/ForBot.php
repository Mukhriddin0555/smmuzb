<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForBot extends Model
{
    use HasFactory;

    protected $fillable = [
        'telegram_user_id',
        'bot_token_id',
    ];
    public $timestamps = false;
    protected $primaryKey = 'telegram_user_id';
    
}
