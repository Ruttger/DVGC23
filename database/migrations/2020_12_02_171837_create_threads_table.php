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
            $table->integer('latest_reply')->unsigned();
            $table->integer('forum_id')->unsigned();
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
