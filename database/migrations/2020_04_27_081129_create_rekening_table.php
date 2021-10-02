<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekeningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekening', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pemilik_id');
            $table->foreign('pemilik_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_bank', 25);
            $table->string('no_rekening', 30);
            $table->string('nama_pemilik', 50);
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
        Schema::dropIfExists('rekening');
    }
}
