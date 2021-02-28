<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBengkelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bengkels', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pemilik')->unsigned();
            $table->foreign('id_pemilik')->references('id')->on('users');
            $table->string('nama_bengkel');
            $table->string('daerah');
            $table->string('kota');
            $table->string('alamat');
            $table->boolean('motor');
            $table->boolean('mobil');
            $table->time('open_hour');
            $table->time('close_hour');
            $table->string('picUrl');
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
        Schema::dropIfExists('bengkels');
    }
}
