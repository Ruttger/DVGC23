<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forums', function (Blueprint $table) {
            $table->integer('id')->unsigned()->autoIncrement();
            $table->string('title');
            $table->string('subtitle');
            $table->integer('category_id')->unsigned();                 // referens to sub categories
            $table->integer('num_threads')->unsigned()->default(0);     // number of threads
            $table->integer('num_views')->unsigned()->default(0);       // number of views
            $table->integer('latest_thread')->unsigned()->default(0);;         // ref latest post
            $table->timestamps();                   // Creates attributes: created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forums');
    }
}
