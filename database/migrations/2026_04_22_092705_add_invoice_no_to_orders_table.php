<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            // invoice
            $table->string('invoice_no')->nullable()->after('order_id');

            // same as cart
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);

            $table->decimal('cgst_amount', 10, 2)->default(0);
            $table->decimal('sgst_amount', 10, 2)->default(0);
            $table->decimal('igst_amount', 10, 2)->default(0);

            $table->enum('gst_type', ['cgst_sgst', 'igst'])->nullable();

            $table->decimal('total_amount', 10, 2)->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'invoice_no',
                'subtotal',
                'discount',
                'cgst_amount',
                'sgst_amount',
                'igst_amount',
                'gst_type',
                'total_amount'
            ]);
        });
    }
};