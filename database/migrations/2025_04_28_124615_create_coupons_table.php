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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->text('description')->nullable();
            $table->enum('type', ['flat', 'percent'])->default('flat');
            $table->float('value', 4, 2)->default(0);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->unsignedInteger('total_quantity')->default(0);
            $table->unsignedInteger('use_per_user')->default(0);
            $table->unsignedInteger('used_quantity')->default(0);
            $table->unsignedMediumInteger('max_discount_value')->default(0);
            $table->unsignedMediumInteger('min_cart_value')->default(0);
            $table->unsignedMediumInteger('max_cart_value')->default(0);
            $table->boolean('is_for_new_user')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
