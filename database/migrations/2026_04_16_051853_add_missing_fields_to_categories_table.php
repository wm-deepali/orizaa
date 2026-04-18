<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingFieldsToCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->unsignedBigInteger('old_id')->nullable()->after('id')->index();

            // Added By
            if (!Schema::hasColumn('categories', 'added_by')) {
                $table->string('added_by')->default('Admin')->after('sub_title');
            }

            // Featured (is new launch)
            if (!Schema::hasColumn('categories', 'is_featured')) {
                $table->boolean('is_featured')->default(0)->after('is_popular');
            }

            // Show on Website
            if (!Schema::hasColumn('categories', 'show_on_website')) {
                $table->boolean('show_on_website')->default(1)->after('is_featured');
            }

            // Is Sub Category (optional)
            if (!Schema::hasColumn('categories', 'is_sub_category')) {
                $table->boolean('is_sub_category')->default(0)->after('parent_id');
            }

            // Soft Deletes
            if (!Schema::hasColumn('categories', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {

            $table->dropColumn([
                'added_by',
                'is_featured',
                'show_on_website',
                'is_sub_category',
                'deleted_at',
                'old_id'
            ]);
        });
    }
}