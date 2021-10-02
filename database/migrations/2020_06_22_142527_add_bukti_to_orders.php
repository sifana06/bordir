<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBuktiToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedInteger('rekening_id')->nullable()->after('product_id');
            $table->date('tanggal_pembayaran')->nullable()->after('tipe_pembayaran');
            $table->string('bukti_transaksi',50)->nullable()->after('order_at');
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
            $table->dropColumn('rekening_id');
            $table->dropColumn('tanggal_pembayaran');
            $table->dropColumn('bukti_transaksi');
        });
    }
}
