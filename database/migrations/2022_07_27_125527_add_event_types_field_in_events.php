<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEventTypesFieldInEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->integer('total_quantity')->nullable()->after('available_quantity');
            $table->date('event_start')->nullable()->after('url');
            $table->time('start_time')->nullable()->after('event_start');
            $table->date('event_end')->nullable()->after('start_time');
            $table->time('end_time')->nullable()->after('event_end');
            $table->boolean('display_start_time')->default(1)->after('end_time');
            $table->boolean('display_end_time')->default(1)->after('display_start_time');
            $table->text('ticket_description')->nullable()->after('min_ticket');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('total_quantity');
            $table->dropColumn('event_start');
            $table->dropColumn('event_end');
            $table->dropColumn('start_time');
            $table->dropColumn('end_time');
            $table->dropColumn('display_start_time');
            $table->dropColumn('display_end_time');
            $table->dropColumn('ticket_description');
        });
    }
}
