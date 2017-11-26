<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailPemesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pemesanan', function (Blueprint $table) {
            $table->increments('id');
            echo 1;
            $table->integer('pemesanan_id')->unsigned();
            echo 12;
            $table->integer('produk_id')->unsigned();
            echo 123;
            $table->integer('quantity');
            echo 1234;
            $table->foreign('pemesanan_id')->references('id')->on('pemesanans')->onDelete('cascade');
            echo 12345;
            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('cascade');
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
        Schema::dropIfExists('detail_pemesanan');
    }
}
