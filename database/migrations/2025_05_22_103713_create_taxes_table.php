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
        Schema::create('taxes', function (Blueprint $table) {
            $table->id();
            $table->string('name');       // e.g. CGST 9%, IGST 18%
            $table->string('type')->nullable();       // enum-like: 'cgst', 'sgst', 'igst', 'cess' etc.
            $table->decimal('rate', 8, 3); // tax rate in percentage, e.g. 9.00
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxes');
    }
};
