<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOpnameTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opnames', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bahan_baku_id')->unsigned();
            $table->integer('volume_opname');
            $table->string('keterangan');
            $table->datetime('tanggal_pemakaian');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('bahan_baku_id')->references('id')->on('bahan_bakus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('opnames');
    }
}
