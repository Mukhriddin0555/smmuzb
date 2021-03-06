<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallBackQuestion extends Model
{
    use HasFactory;
    protected $fillable = array('telegram_user_id', 'question_id');
}
