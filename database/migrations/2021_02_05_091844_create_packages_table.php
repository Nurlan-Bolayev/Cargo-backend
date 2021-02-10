<?php

use App\Models\OverseasAddress;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class,'owner_id')->constrained('users')->cascadeOnDelete();
            $table->string('store')->nullable();
            $table->integer('tracking_code')->nullable();
            $table->foreignIdFor(OverseasAddress::class, 'start_point_id')->constrained('overseas_addresses');
            $table->string('order_date')->nullable();
            $table->integer('price')->nullable();
            $table->integer('weight');
            $table->integer('shipping_price');
            $table->string('dimensions');
            $table->boolean('guarantee');
            $table->text('product_description')->nullable();
            $table->string('invoice')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('packages');
    }
}
