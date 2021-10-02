<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pemilik_id');
            $table->foreign('pemilik_id')->references('id')->on('users');
            $table->unsignedBigInteger('pelanggan_id');
            $table->foreign('pelanggan_id')->references('id')->on('users');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->unsignedBigInteger('rekening_id');
            $table->foreign('rekening_id')->references('id')->on('rekening');
            $table->unsignedBigInteger('toko_id');
            $table->foreign('toko_id')->references('id')->on('stores');
            $table->string('kode_transaksi', 15);
            $table->date('tanggal_transaksi');
            $table->string('status',15);
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
        Schema::dropIfExists('transactions');
    }
}
