<?php

use App\Models\ClientStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelegramUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telegram_users', function (Blueprint $table) {
            $table->id();
            $table->integer('telegram_id')->unique();
            $table->string('number')->unique();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('original_last_name')->nullable();
            $table->string('original_first_name')->nullable();
            $table->string('number2')->unique();
            $table->string('active')->default(0);
            $table->foreignIdFor(ClientStatus::class);
            $table->integer('discount_number')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telegram_users');
    }
}
