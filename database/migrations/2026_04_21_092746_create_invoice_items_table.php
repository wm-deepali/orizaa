<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('invoice_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('article_no')->nullable();
            $table->string('description');

            $table->integer('qty')->default(1);
            $table->decimal('rate', 12, 2)->default(0);

            // 🔥 Important (your controller uses this)
            $table->decimal('discount', 12, 2)->default(0);
            $table->string('discount_type')->default('flat');

            $table->decimal('gst', 8, 2)->default(0);
            $table->decimal('price', 12, 2)->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoice_items');
    }
};