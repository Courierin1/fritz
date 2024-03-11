<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            // event basic info
            $table->string('title');
            $table->string('venue_name');
            $table->unsignedBigInteger('event_planner_id');
            $table->unsignedBigInteger('organizer_id');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('sub_category_id');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('state_id');
            $table->string('city')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('location_type')->nullable();
            $table->string('address')->nullable();
            $table->string('url')->nullable();
            // event details
            $table->string('image')->nullable();
            $table->longText('summary')->nullable();
            $table->longText('details')->nullable();
            // event ticket details
            $table->string('ticket_type')->nullable();
            $table->string('name')->nullable();
            $table->integer('available_quantity')->nullable();
            $table->decimal('price', $precision = 8, $scale = 2)->nullable()->default(0);
            $table->date('sale_start')->nullable();
            $table->time('sale_start_time')->nullable();
            $table->date('sale_end')->nullable();
            $table->time('sale_end_time')->nullable();
            $table->integer('max_ticket')->nullable();
            $table->integer('min_ticket')->nullable();
            $table->string('status')->nullable();
            $table->string('step')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('event_planner_id')->constrained()->references('id')->on('users')->onDelete('cascade');
            $table->foreign('organizer_id')->constrained()->references('id')->on('event_organizers')->onDelete('cascade');
            $table->foreign('type_id')->constrained()->references('id')->on('event_types')->onDelete('cascade');
            $table->foreign('category_id')->constrained()->references('id')->on('event_categories')->onDelete('cascade');
            $table->foreign('sub_category_id')->constrained()->references('id')->on('event_categories')->onDelete('cascade');
            $table->foreign('country_id')->constrained()->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('state_id')->constrained()->references('id')->on('states')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
