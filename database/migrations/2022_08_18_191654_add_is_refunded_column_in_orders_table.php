<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsRefundedColumnInOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('is_refunded')->nullable()->default(0)->after('order_status');
            $table->integer('refund_requested')->nullable()->default(0)->after('is_refunded');
            $table->integer('refund_status')->nullable()->after('refund_requested');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('is_refunded');
            $table->dropColumn('refund_requested');
            $table->dropColumn('refund_status');
        });
    }
}
