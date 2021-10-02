<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pemilik_id');
            $table->foreign('pemilik_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama', 50)->unique();
            $table->text('foto')->nullable();
            $table->string('phone', 13);
            $table->string('kabupaten',3);
            $table->string('kecamatan',3);
            $table->string('desa',3);
            $table->text('alamat');
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
        Schema::dropIfExists('stores');
    }
}
