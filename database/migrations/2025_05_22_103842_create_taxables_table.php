<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('taxables', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignId('tax_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('taxable_id');
            $table->string('taxable_type');
            $table->index(['taxable_id', 'taxable_type']);

            $table->decimal('tax_rate', 5, 2);     // snapshot of tax rate at time of creation
            $table->decimal('base_amount', 10, 2); // price or subtotal
            $table->decimal('tax_amount', 10, 2);  // calculated tax amount

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxables');
    }
};
