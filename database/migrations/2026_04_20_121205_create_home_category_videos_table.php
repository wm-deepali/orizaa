<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeCategoryVideosTable extends Migration
{
    public function up()
    {
        Schema::create('home_category_videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');          // Kurta Sets, Sharara Set etc.
            $table->string('video');          // video file path
            $table->string('link')->nullable(); // optional (if you want clickable)
            $table->integer('order')->default(0); // for sorting
            $table->boolean('status')->default(1); // active/inactive
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('home_category_videos');
    }
}