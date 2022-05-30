<?php

use App\Models\BotToken;
use App\Models\TelegramUser;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBottokenTelegramuserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bot_token_telegram_user', function (Blueprint $table) {
            $table->primary(['bot_token_id', 'telegram_user_id']);
            $table->foreignIdFor(BotToken::class)->constrained();
            $table->foreignIdFor(TelegramUser::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bottoken_telegramuser');
    }
}
