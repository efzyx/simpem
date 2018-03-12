<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKodeColumnToBahanBakusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bahan_bakus', function (Blueprint $table) {
            $table->string('kode');
            $table->integer('sisa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bahan_bakus', function (Blueprint $table) {
            $table->dropColumn('kode');
            $table->dropColumn('sisa');
        });
    }
}
