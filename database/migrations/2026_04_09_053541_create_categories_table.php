<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->unique();

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->string('image')->nullable();

            // 🔥 parent-child relation
            $table->unsignedBigInteger('parent_id')->nullable();

            $table->boolean('is_popular')->default(0);
            $table->boolean('status')->default(1);

            $table->timestamps();

            // foreign key (optional but recommended)
            $table->foreign('parent_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}