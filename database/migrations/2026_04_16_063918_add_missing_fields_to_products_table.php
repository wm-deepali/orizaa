<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingFieldsToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {

            // 🔥 OLD SYSTEM MAPPING
            if (!Schema::hasColumn('products', 'old_id')) {
                $table->unsignedBigInteger('old_id')->nullable()->after('id')->index();
            }

            // 🔥 BASIC EXTRA FIELDS
            if (!Schema::hasColumn('products', 'product_code')) {
                $table->string('product_code')->nullable()->after('name');
            }

            if (!Schema::hasColumn('products', 'brand_id')) {
                $table->unsignedBigInteger('brand_id')->nullable()->after('product_code');
            }

            if (!Schema::hasColumn('products', 'added_by')) {
                $table->string('added_by')->nullable()->after('brand_id');
            }

            if (!Schema::hasColumn('products', 'sort_order')) {
                $table->integer('sort_order')->nullable()->after('added_by');
            }

            // 🔥 FLAGS
            if (!Schema::hasColumn('products', 'show_on_website')) {
                $table->boolean('show_on_website')->default(1)->after('status');
            }

            if (!Schema::hasColumn('products', 'is_premium')) {
                $table->boolean('is_premium')->default(0)->after('show_on_website');
            }

            if (!Schema::hasColumn('products', 'is_engraving')) {
                $table->boolean('is_engraving')->default(0)->after('is_premium');
            }

            if (!Schema::hasColumn('products', 'best_seller')) {
                $table->boolean('best_seller')->default(0)->after('is_engraving');
            }
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {

            $table->dropColumn([
                'old_id',
                'product_code',
                'brand_id',
                'added_by',
                'sort_order',
                'show_on_website',
                'is_premium',
                'is_engraving',
                'best_seller',
            ]);
        });
    }
}