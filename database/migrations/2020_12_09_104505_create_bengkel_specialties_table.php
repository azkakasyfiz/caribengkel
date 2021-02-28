<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBengkelSpecialtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bengkel_specialties', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_bengkel')->unsigned();
            $table->foreign('id_bengkel')->references('id')->on('bengkels');
            $table->bigInteger('id_brand')->unsigned();
            $table->foreign('id_brand')->references('id')->on('brands');
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
        Schema::dropIfExists('bengkel_specialties');
    }
}
