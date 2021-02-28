<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBengkelProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bengkel_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_bengkel')->unsigned();
            $table->foreign('id_bengkel')->references('id')->on('bengkels');
            $table->bigInteger('id_categories')->unsigned();
            $table->foreign('id_categories')->references('id')->on('sparepart_categories');
            $table->string('nama_product');
            $table->integer('quantity');
            $table->integer('harga'); //harga satuan
            $table->string('kendaraan'); //mobil atau motor
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
        Schema::dropIfExists('bengkel_products');
    }
}
