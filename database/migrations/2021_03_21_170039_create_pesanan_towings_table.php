<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananTowingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan_towings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pemesan')->unsigned();
            $table->foreign('id_pemesan')->references('id')->on('users');
            $table->string('nama_pemesan');
            $table->string('no_hp');
            $table->string('alamat');
            $table->time('time');
            $table->date('date');
            $table->bigInteger('id_bengkel_tujuan')->unsigned();
            $table->foreign('id_bengkel_tujuan')->references('id')->on('bengkels');
            $table->string('status');
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
        Schema::dropIfExists('pesanan_towings');
    }
}
