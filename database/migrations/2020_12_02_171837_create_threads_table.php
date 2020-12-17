<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->integer('id')->unsigned()->autoIncrement();
            $table->string('title');
            $table->text('body');
            $table->integer('num_replies')->unsigned()->default(0);
            $table->integer('num_views')->unsigned()->default(0);
            $table->integer('latest_reply')->unsigned()->default(0);
            $table->integer('forum_id')->unsigned();
            // om forumet som trådens FK pekar på tas bort, ta bort tråden
            $table->foreign('forum_id')->references('id')->on('forums')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
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
        Schema::dropIfExists('threads');
    }
}