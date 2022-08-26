<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_registration', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id');
            $table->string('ic_passport_no');
            $table->string('ic_passport_photo');
            $table->string('country');
            $table->string('default_currency');
            $table->string('address1');
            $table->string('address2');
            $table->string('city');
            $table->string('zip_code');
            $table->string('state_region');
            $table->string('phone_no');
            $table->string('email')->unique();
            $table->string('account_referral_code');
            $table->string('account_type');
            $table->string('company_name');
            $table->string('company_reg_no');
            $table->string('business_nature');
            $table->string('company_description');
            $table->string('ssm_form');
            $table->string('utility_bill');
            $table->string('partner_code');
            $table->string('shop_logo');
            $table->string('shop_name');
            $table->string('shop_description');
            $table->string('selling_item_type');
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
        Schema::dropIfExists('member_registration');
    }
}
