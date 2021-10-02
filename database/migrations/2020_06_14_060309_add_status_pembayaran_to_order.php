<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusPembayaranToOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('tipe_pengiriman');
            $table->string('status_pembayaran',15)->nullable()->after('status_order');
        });
        
        Schema::table('transactions', function (Blueprint $table) {
            $table->text('bukti_pembayaran')->nullable()->after('kode_transaksi');
            $table->dropColumn('kode_transaksi');
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
            $table->dropColumn('status_pembayaran');
        });
        
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('bukti_pembayaran');
        });
    }
}
