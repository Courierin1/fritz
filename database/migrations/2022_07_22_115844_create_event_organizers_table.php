<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventOrganizersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_organizers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('event_planner_id');
            $table->string('tax_id');
            $table->string('address');
            $table->string('website')->nullable();
            $table->string('image');
            $table->LONGTEXT('bio');
            $table->LONGTEXT('description');
            $table->string('bank_name');
            $table->string('account_no');
            $table->string('routing_number');
            $table->string('account_type');
            // $table->integer('distribution')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign('event_planner_id')->constrained()->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_organizers');
    }
}
