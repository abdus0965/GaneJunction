<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabcheckSeo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labcheck_seo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('labcheck_tags');
            $table->string('meta_keywords');
            $table->string('meta_description',1024);
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
        Schema::dropIfExists('labcheck_seo');
    }
}
