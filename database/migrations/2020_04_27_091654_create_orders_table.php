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
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('store_id');
            $table->foreign('store_id')->references('id')->on('stores');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->string('order_number')->unique();
            $table->text('foto')->nullable();
            $table->string('jenis_bordir', 15)->nullable();
            $table->text('keterangan')->nullable();
            
            $table->string('nama_pelanggan', 50);
            $table->string('email',50)->nullable();
            $table->string('telepon', 13);
            $table->integer('kabupaten');
            $table->integer('kecamatan');
            $table->integer('desa');
            $table->text('alamat');

            $table->text('catatan');
            $table->date('deadline');
            $table->integer('jumlah');
            $table->bigInteger('harga')->nullable();
            $table->bigInteger('total')->nullable();
            $table->string('status_order',15)->nullable();
            $table->string('status_pengiriman',15)->nullable();
            $table->string('tipe_pembayaran', 15)->nullable();
            $table->string('tipe_pengiriman', 15)->nullable();

            $table->timestamp('order_at')->nullable();
            $table->timestamp('received_at')->nullable();
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
