<?php

use App\Models\Products;
use App\Models\SaleProduct;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleTodaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_todays', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SaleProduct::class);
            $table->foreignIdFor(Products::class);
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
        Schema::dropIfExists('sale_todays');
    }
}
