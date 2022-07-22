<?php

use App\Models\Customer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerSalesmenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_salesmen', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Customer::class);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('number');
            $table->bigInteger('sales')->default(0);
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
        Schema::dropIfExists('customer_salesmen');
    }
}
