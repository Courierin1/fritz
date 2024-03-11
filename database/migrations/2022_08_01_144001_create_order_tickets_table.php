<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('event_id');
            $table->string('ticket_type');
            $table->integer('no_of_tickets');
            $table->decimal('unit_price', $precision = 8, $scale = 2)->nullable()->default(0);
            $table->decimal('ticket_fee_percentage', $precision = 8, $scale = 2)->nullable()->default(0);
            $table->decimal('ticket_fee', $precision = 8, $scale = 2)->nullable()->default(0);
            $table->decimal('ticket_price', $precision = 8, $scale = 2)->nullable()->default(0);
            $table->decimal('admin_comission', $precision = 8, $scale = 2)->nullable()->default(0);
            $table->decimal('organizer_comission', $precision = 8, $scale = 2)->nullable()->default(0);
            $table->timestamps();
            
            $table->foreign('order_id')->constrained()->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('event_id')->constrained()->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_tickets');
    }
}
