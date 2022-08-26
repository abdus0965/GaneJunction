<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabcheckAccessoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labcheck_accessories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('labcheck_size');
            $table->string('labcheck_color');
            $table->string('price');
            $table->string('price_type');
            $table->decimal('weight');
            $table->string('labcheck_size_image');
            $table->string('labcheck_color_image');
            $table->enum('status', [0, 1])->default(1);
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
        Schema::dropIfExists('labcheck_accessories');
    }
}
