<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses_customers', function (Blueprint $table) {
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('address_id')->unsigned();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('address_id')->references('id')->on('addresses');
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
        Schema::dropIfExists('addresses_customers');
    }
}
