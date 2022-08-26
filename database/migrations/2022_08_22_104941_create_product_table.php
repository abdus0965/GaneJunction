<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->string('name');
            $table->string('short_description');
            $table->string('main_description', 1024);
            $table->string('sku');
            $table->integer('inventory_id');
            $table->integer('discount_id');
            $table->decimal('price');
            $table->integer('min_qty');
            $table->integer('max_qty');
            $table->integer('stock_quantity');
            $table->string('main_image');
            $table->enum('enable_product_option', [0, 1])->default(0);
            $table->enum('online_status', [0, 1]);
            $table->enum('status', [0, 1])->default(0);
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
        Schema::dropIfExists('product');
    }
}
