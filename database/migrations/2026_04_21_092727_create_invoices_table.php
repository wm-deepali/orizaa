<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            // Invoice details
            $table->string('invoice_no')->unique();
            $table->date('date');

            // Customer
            $table->string('customer_name');
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('state_code')->nullable();
            $table->string('gstin')->nullable();
            $table->string('zip')->nullable();

            // Totals
            $table->decimal('total_taxable', 12, 2)->default(0);
            $table->decimal('total_tax', 12, 2)->default(0);
            $table->decimal('total_amount', 12, 2)->default(0);

            // Footer
            $table->text('amount_in_words')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};