<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->integer('id')->unsigned()->autoIncrement();
            $table->text('body');
            $table->integer('thread_id')->unsigned();
            // om tråden som svarets FK pekar på tas bort, ta bort svaret
            $table->foreign('thread_id')->references('id')->on('threads')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->enum('rights', array('admin', 'agent', 'user'));
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
        Schema::dropIfExists('replies');
    }
}
