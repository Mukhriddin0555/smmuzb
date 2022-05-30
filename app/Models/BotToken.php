<?php

namespace App\Models;

use App\Models\TelegramUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BotToken extends Model
{
    use HasFactory;

    public function telegramusers(){
        return $this->belongsToMany(TelegramUser::class);
    }
}
