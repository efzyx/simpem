<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePengadaansTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengadaans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bahan_baku_id')->unsigned();
            $table->integer('berat');
            $table->string('supplier');
            $table->datetime('tanggal_pengadaan');
            $table->integer('user_id')->unsigned();
            $table->string('keterangan');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('bahan_baku_id')->references('id')->on('bahan_bakus');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pengadaans');
    }
}
