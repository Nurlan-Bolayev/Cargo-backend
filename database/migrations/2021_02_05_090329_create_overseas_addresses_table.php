<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOverseasAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overseas_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('country');
            $table->json('additional')->nullable();
            $table->string('address')->nullable();
            $table->string('ID_card_number')->nullable();
            $table->string('phone_number');
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
        Schema::dropIfExists('overseas_addresses');
    }
}
