<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKabupatenKotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kabupaten', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama',15);
            $table->timestamps();
        });
        
        Schema::create('kecamatan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kabupaten_id');
            $table->foreign('kabupaten_id')->references('id')->on('kabupaten');
            $table->string('nama',25);
            $table->timestamps();
        });

        Schema::create('desa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kecamatan_id');
            $table->foreign('kecamatan_id')->references('id')->on('kecamatan');
            $table->string('nama',25);
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
        Schema::dropIfExists('kabupaten');
        Schema::dropIfExists('kecamatan');
        Schema::dropIfExists('desa');
    }
}
