<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('ready_to_ship')->after('pan_india')->default(0);
            $table->boolean('bulk_available')->after('ready_to_ship')->default(0);
            $table->boolean('gift_hamper')->after('bulk_available')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'ready_to_ship',
                'bulk_available',
                'gift_hamper'
            ]);
        });
    }
};

