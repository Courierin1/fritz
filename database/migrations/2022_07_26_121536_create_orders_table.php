<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('order_number');
            $table->unsignedBigInteger('user_id');
            // $table->integer('no_of_tickets');
            // $table->decimal('unit_price', $precision = 8, $scale = 2)->nullable()->default(0);
            $table->decimal('ticket_fee_percentage', $precision = 8, $scale = 2)->nullable()->default(0);
            $table->decimal('total_ticket_fee', $precision = 8, $scale = 2)->nullable()->default(0);
            $table->decimal('total_ticket_price', $precision = 8, $scale = 2)->nullable()->default(0);
            $table->decimal('total_admin_comission', $precision = 8, $scale = 2)->nullable()->default(0);
            $table->decimal('total_organizer_comission', $precision = 8, $scale = 2)->nullable()->default(0);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('payment_method');
            $table->string('payment_status')->default('0');
            $table->integer('order_status');
            
            $table->foreign('user_id')->constrained()->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
