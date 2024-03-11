<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('prefix')->nullable();
            $table->string('img')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('suffix')->nullable();
            $table->string('home_phone')->nullable();
            $table->string('cell_phone')->nullable();
            $table->string('job_title')->nullable();
            $table->string('company')->nullable();
            $table->string('website')->nullable();
            $table->string('blog')->nullable();
            $table->string('home_address_one')->nullable();
            $table->string('home_address_two')->nullable();
            $table->string('home_address_city')->nullable();
            $table->string('home_address_country')->nullable();
            $table->integer('home_address_zip_code')->nullable();
            $table->string('home_address_state')->nullable();
            $table->string('billing_address_one')->nullable();
            $table->string('billing_address_two')->nullable();
            $table->string('billing_address_city')->nullable();
            $table->string('billing_address_country')->nullable();
            $table->integer('billing_address_zip')->nullable();
            $table->string('billing_address_state')->nullable();
            $table->string('shipping_address_one')->nullable();
            $table->string('shipping_address_two')->nullable();
            $table->string('shipping_address_city')->nullable();
            $table->string('shipping_address_country')->nullable();
            $table->integer('shipping_address_zip')->nullable();
            $table->string('shipping_address_state')->nullable();
            $table->string('work_address_one')->nullable();
            $table->string('work_address_two')->nullable();
            $table->string('work_address_city')->nullable();
            $table->string('work_address_country')->nullable();
            $table->integer('work_address_zip')->nullable();
            $table->string('work_address_state')->nullable();
            $table->string('distribution')->nullable();
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
        Schema::dropIfExists('user_details');
    }
}
