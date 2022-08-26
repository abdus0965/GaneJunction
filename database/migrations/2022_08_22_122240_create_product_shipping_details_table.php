<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductShippingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_shipping_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('require_shipping');
            $table->string('ship_world_wide');
            $table->decimal('width');
            $table->decimal('length');
            $table->decimal('height');
            $table->string('unit');
            $table->decimal('weight');
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
        Schema::dropIfExists('product_shipping_details');
    }
}
