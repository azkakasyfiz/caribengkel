<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBengkelDiscussionRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bengkel_discussion_replies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_bengkel')->unsigned();
            $table->bigInteger('id_user')->unsigned();
            $table->bigInteger('id_discussion')->unsigned();
            $table->string('message');
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
        Schema::dropIfExists('bengkel_discussion_replies');
    }
}
