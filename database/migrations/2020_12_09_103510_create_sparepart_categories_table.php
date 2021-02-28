<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSparepartCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sparepart_categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_brand')->unsigned();
            $table->foreign('id_brand')->references('id')->on('brands');
            $table->string('nama');
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
        Schema::dropIfExists('sparepart_categories');
    }
}
