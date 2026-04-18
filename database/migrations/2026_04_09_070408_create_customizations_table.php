<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('customizations', function (Blueprint $table) {
            $table->id();

            $table->string('name'); // Customization Name
            $table->text('short_description')->nullable(); // Optional

            $table->boolean('status')->default(1); // Active / Inactive

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customizations');
    }

};
