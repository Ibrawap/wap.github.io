<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id')->nullable()->constrains();
            $table->string('artiste')->nullable();
            $table->string('featuring')->nullable();
            $table->unsignedBigInteger('album_id')->nullable();
            $table->string('producer')->nullable();
            $table->string('prefix')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('tags')->nullable();
            $table->timestamp('released_date')->nullable();
            $table->string('path');
            $table->integer('status')->default(0);
            $table->text('desc')->nullable();
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
        Schema::dropIfExists('songs');
    }
}
